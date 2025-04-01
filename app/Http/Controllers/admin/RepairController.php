<?php

namespace App\Http\Controllers\admin;

use App\Models\Repair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Tool;
use Illuminate\Support\Facades\Validator;

class RepairController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $repairs = Repair::with('tool')->orderBy('created_at', 'desc')->get();
        return view('admin.repair.index', [
            'active' => 'maintenance',
            'open' => 'repair',
            'link' => 'repair | ',
            'repairs' => $repairs
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Repair $repair)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Repair $repair)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Repair $repair)
    {
        $sanitize = [
            'date' => strip_tags($request->input('date')),
            'cost' => strip_tags($request->input('cost')),
            'status' => strip_tags($request->input('status')),
            'notes' => strip_tags($request->input('notes'))
        ];

        $credential = Validator::make($sanitize, [
            'date' => ['required', 'date'],
            'cost' => ['required', 'numeric'],
            'notes' => ['required', 'string'],
            'status' => [
                'required',
                'in:in_progress,done'
            ]
        ]);

        if ($credential->fails()) {
            return redirect()->route('admin.repair.index')->withErrors($credential)->with(['errorFrom' => 'update'])->withInput($request->all() + ['id' => $repair->id]);
        }

        $validatedData = $credential->validate();
        DB::transaction(function () use ($validatedData, $repair) {
            $repair->update([
                'completion_date' => $validatedData['date'],
                'status' => $validatedData['status'],
                'cost' => $validatedData['cost'],
                'description' => $validatedData['notes']
            ]);

            if ($validatedData['status'] === 'done') {
                $tool = Tool::find($repair->tool_code);
                $tool->update(['status' => 'available']);
            }
        });

        return redirect()->route('admin.repair.index')->with('message', 'success to confirm repair!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Repair $repair)
    {
        //
    }
}
