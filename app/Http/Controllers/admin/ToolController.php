<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tools = Tool::with('category')->get();
        return view('admin.tool.index', [
            'active' => 'master',
            'open' => 'tool',
            'link' => 'Tool | ',
            'tools' => $tools,
            'categories' => Category::all()
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
            'category_id' => strip_tags($request->input('category_id')),
            'name' => strip_tags(ucwords(strtolower($request->input('name')))),
            'condition' => strip_tags($request->input('condition')),
            'status' => strip_tags($request->input('status'))
        ];

        $credential = Validator::make($sanitize, [
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'min:3', 'unique:tools,name'],
            'condition' => ['required', 'string', 'min:4'],
            'status' => ['required', 'string', 'in:available,repair,maintenance,damaged,borrowed'],
        ]);

        if ($credential->fails()) {
            return redirect()->back()->withErrors($credential)->with('toolType', 'store')->withInput();
        }

        $validatedData = $credential->validate();
        $categoryQuantity = Category::whereId($validatedData['category_id'])->value('quantity');
        $categoryName = Category::whereId($validatedData['category_id'])->value('name');
        $toolCountById = Tool::where('category_id', $validatedData['category_id'])->count();

        if ($toolCountById < $categoryQuantity) {

            $categoryWords = explode(' ', strtoupper($categoryName));

            $prefix = count($categoryWords) === 1 ? substr($categoryWords[0], 0, 2) : implode('', array_map(fn($word) => $word[0], $categoryWords));
            $dateCode = now()->format('ymd');
            $nexToIndex = str_pad($toolCountById + 1, 3, '0', STR_PAD_LEFT);

            $toolCode = "{$prefix}{$dateCode}{$nexToIndex}";

            while (Tool::where('tool_code', $toolCode)->exists()) {
                $toolCountById++;
                $nexToIndex = str_pad($toolCountById + 1, 3, '0', STR_PAD_LEFT);
                $toolCode = "{$prefix}{$dateCode}{$nexToIndex}";
            }

            $toolExists = Tool::where('tool_code', $toolCode)->value('tool_code');

            if ($toolExists !== null) {
                return redirect()->back()->withErrors(['error' => 'Failed to create new Tool Code!'])->with('toolType', 'store')->withInput();
            }
            $data = [
                'tool_code' => $toolCode,
                'name' => $validatedData['name'],
                'condition' => $validatedData['condition'],
                'status' => $validatedData['status'],
                'category_id' => $validatedData['category_id']
            ];
            DB::transaction(function () use ($data) {
                Tool::create($data);
            });

            return redirect()->back()->with('message', 'Success to add new tool!');
        }

        return redirect()->back()->withErrors(['error' => "Quantity for category $categoryName is full"])->with('toolType', 'store')->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(Tool $tool)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tool $tool)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tool $tool)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tool $tool)
    {
        //
    }
}
