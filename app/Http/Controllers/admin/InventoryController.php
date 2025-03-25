<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories = Inventory::with('category')->orderBy('created_at', 'desc')->get();
        return view('admin.inventory.index', [
            'active' => 'master',
            'open' => 'inventory',
            'link' => 'Inventory | ',
            'inventories' => $inventories,
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
            'category_id' => strip_tags($request->input('category')),
            'date' => strip_tags($request->input('date')),
            'quantity' => strip_tags($request->input('qty')),
            'vendor' => strip_tags($request->input('vendor')),
            'notes' => strip_tags($request->input('notes')),
            'price' => strip_tags($request->input('price')),
        ];

        $credential = Validator::make($sanitize, [
            'category_id' => ['required', 'exists:categories,id'],
            'date' => ['required', 'date'],
            'quantity' => ['required', 'numeric'],
            'vendor' => ['required', 'string'],
            'notes' => ['required', 'string'],
            'price' => ['required', 'numeric']
        ]);

        if ($credential->fails()) {
            return redirect()->back()->withErrors($credential)->with('errorType', 'store')->withInput();
        }

        DB::transaction(function () use ($credential) {
            $validatedData = $credential->validated();
            Inventory::create($validatedData);
            Category::where('id', $validatedData['category_id'])->increment('quantity', $validatedData['quantity']);
        });

        return redirect()->back()->with('message', 'Success to add inventory!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        $sanitize = [
            'category_id' => strip_tags($request->input('category')),
            'date' => strip_tags($request->input('date')),
            'quantity' => strip_tags($request->input('qty')),
            'vendor' => strip_tags($request->input('vendor')),
            'notes' => strip_tags($request->input('notes')),
            'price' => strip_tags($request->input('price')),
        ];

        $credential = Validator::make($sanitize, [
            'category_id' => ['required', 'exists:categories,id'],
            'date' => ['required', 'date'],
            'quantity' => ['required', 'numeric'],
            'vendor' => ['required', 'string'],
            'notes' => ['required', 'string'],
            'price' => ['required', 'numeric']
        ]);

        if ($credential->fails()) {
            return redirect()->back()->withErrors($credential)->with(['errorFrom' => 'update'])->withInput($request->all() + ['id' => $inventory->id]);
        }

        DB::transaction(function () use ($credential, $inventory) {
            $validatedData = $credential->validate();
            $oldInventoryQuantity = $inventory->quantity;

            $inventory->update($validatedData);

            $category = Category::find($validatedData['category_id']);
            if ($category) {
                $category->update([
                    'quantity' => DB::raw("quantity - $oldInventoryQuantity + " . $validatedData['quantity'])
                ]);
            }
        });

        return redirect()->back()->with('message', 'Success to update inventory!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        //
    }
}
