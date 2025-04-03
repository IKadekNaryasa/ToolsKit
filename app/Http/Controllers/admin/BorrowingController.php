<?php

namespace App\Http\Controllers\admin;

use App\Models\Tool;
use App\Models\User;
use App\Models\Borrowing;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BorrowingDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $borrowings = Borrowing::with(['user', 'detail.tool'])->orderBy('created_at', 'desc')->get();
        return view('admin.borrowing.index', [
            'active' => 'transaction',
            'open' => 'borrowing',
            'link' => 'borrowing | ',
            'borrowings' => $borrowings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sanitize = [
            'date' => strip_tags($request->input('date')),
            'user_id' => $request->input('user_id'),
            'notes' => strip_tags($request->input('notes')),
            'tool_code' => implode(',', $request->input('tool_code'))
        ];

        $credential = Validator::make($sanitize, [
            'date' => ['required', 'date'],
            'user_id' => ['required', 'exists:users,id'],
            'notes' => ['string', 'required'],
            'tool_code' => ['required']
        ])->validate();

        $prefix = "TRS";
        $dateOf = str_replace('-', '', $credential['date']);
        $lastCode = Borrowing::where('borrowing_code', 'like', "$prefix$dateOf%")->orderBy('borrowing_code', 'DESC')->value('borrowing_code');
        if ($lastCode) {
            $lastIndex = (int) substr($lastCode, -3);
            $index = str_pad($lastIndex + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $index = "001";
        }

        $code = $prefix . $dateOf . $index;
        $admin = Auth::user()->id;
        $data = [
            'borrowing_code' => $code,
            'user_id' => $credential['user_id'],
            'borrow_date' => $credential['date'],
            'return_date' => $credential['date'],
            'notes' => $credential['notes'],
            'status' => 'borrowed',
            'admin_id' => $admin
        ];


        DB::transaction(function () use ($credential, $data) {
            Borrowing::create($data);
            $tools = explode(',', $credential['tool_code']);

            foreach ($tools as $tool) {
                BorrowingDetail::create([
                    'borrowing_code' => $data['borrowing_code'],
                    'tool_code' => trim($tool)
                ]);

                $tool = Tool::find($tool);
                $tool->update(['status' => 'borrowed']);
            }
        });

        session()->forget(['transId', 'transToolId', 'transTools', 'transUsername', 'transName', 'transContact']);
        return redirect()->route('admin.borrowing.index')->with('message', 'Transaction success!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Borrowing $borrowing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Borrowing $borrowing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Borrowing $borrowing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrowing $borrowing)
    {
        //
    }


    public function newTransaction()
    {
        return view('admin.borrowing.new-transaction', [
            'active' => 'transaction',
            'open' => 'borrowing',
            'link' => 'borrowing | new transaction | add user ',
            'persent' => '33.3%',
        ]);
    }

    public function transUser(Request $request)
    {
        $data = [
            'username' => strip_tags($request->input('username'))
        ];
        $credential = Validator::make($data, [
            'username' => ['required', 'string', 'exists:users,username']
        ]);
        if ($credential->fails()) {
            return redirect()->route('admin.borrowing.new-transaction')->withErrors($credential)->withInput();
        }

        $validatedData = $credential->validate();
        if ($validatedData['username'] === session('transUsername')) {
            return redirect()->route('admin.borrowing.new-transaction')->withErrors(['error' => 'user already added!'])->withInput();
        }
        $user = User::where('username', $validatedData['username'])->first();
        if ($user->status !== 'active') {
            return redirect()->route('admin.borrowing.new-transaction')->withErrors(['error' => 'this user is suspended!'])->withInput();
        }
        self::transSession($user);
        return redirect()->route('admin.borrowing.new-transaction')->with('message', 'user added!');
    }

    private static function transSession($user)
    {
        $data = [
            'transId' => $user->id,
            'transUsername' => $user->username,
            'transName' => $user->name,
            'transContact' => $user->contact
        ];
        return session($data);
    }

    public function transToolView()
    {
        if (!session('transId')) {
            return redirect()->back()->withErrors(['error' => 'add user first to continue transaction!']);
        }
        return view('admin.borrowing.trans-tool', [
            'active' => 'transaction',
            'open' => 'borrowing',
            'link' => 'borrowing | new transaction | add tool ',
            'persent' => '66.6%',
        ]);
    }

    public function transTool(Request $request)
    {
        $sanitize = [
            'tool_code' => strip_tags($request->input('tool_code'))
        ];
        $credential = Validator::make($sanitize, [
            'tool_code' => ['required', 'exists:tools,tool_code']
        ]);

        if ($credential->fails()) {
            return redirect()->route('admin.borrowing.trans-tool')->withErrors($credential)->withInput();
        }
        $data = $credential->validate();

        if (!session()->has(['transToolId'])) {
            session(['transToolId' => Str::uuid()]);
        }

        $tool = Tool::where('tool_code', $data['tool_code'])->where('status', 'available')->first();
        if (!$tool) {
            return redirect()->route('admin.borrowing.trans-tool')->withErrors(['error' => 'tool not available!'])->withInput();
        }
        $toolCode = $tool['tool_code'];
        $tools = session('transTools', []);
        $existingTool = collect($tool)->firstWhere('tool_code', $tool->tool_code);
        if (!$existingTool) {
            $tools[] = [
                'toolCode' => $tool->tool_code,
                'toolName' => $tool->name
            ];
            session(['transTools' => $tools]);
        }
        return redirect()->route('admin.borrowing.trans-tool')->with('message', "tool $toolCode added!");
    }

    public function transToolRemove(Request $request)
    {
        $sanitize = [
            'tool_code' => strip_tags($request->input('tool_code'))
        ];

        $credential = Validator::make($sanitize, [
            'tool_code' => ['required']
        ])->validate();

        $toolCode = $credential['tool_code'];
        $tools = session('transTools', []);
        $tools = array_filter($tools, function ($tool) use ($toolCode) {
            return $tool['toolCode'] !== $toolCode;
        });
        session(['transTools' => array_values($tools)]);
        if (empty(session('transTools'))) {
            session()->forget('transToolId');
            session()->forget('transTools');
        }
        return redirect()->route('admin.borrowing.trans-tool')->with('message', "Tool $toolCode Removed!");
    }

    public function cart()
    {
        return view('admin.borrowing.cart', [
            'active' => 'transaction',
            'open' => 'borrowing',
            'link' => 'borrowing | new transaction | cart ',
            'persent' => '100%',
        ]);
    }

    public function cancel()
    {
        session()->forget(['transId', 'transToolId', 'transTools', 'transUsername', 'transName', 'transContact']);
        return redirect()->route('admin.borrowing.index')->withErrors(['error' => 'Transaction canceled!']);
    }
}
