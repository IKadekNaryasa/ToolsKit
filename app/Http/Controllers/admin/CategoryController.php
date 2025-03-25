<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view(
            'admin.category.index',
            [
                'active' => 'master',
                'open' => 'category',
                'link' => 'Category | ',
                'categories' => $categories
            ]
        );
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
            'name' => strip_tags($request->input('name'))
        ];

        $credential = Validator::make($sanitize, [
            'name' => ['required', 'string', 'unique:categories,name']
        ])->validate();

        $name = ucwords(strtolower($credential['name']));

        $store = Category::create(['name' => $name]);

        if (!$store) {
            return redirect()->back()->withErrors(['error', 'Failed to create new category!'])->withInput();
        }

        return redirect()->back()->with('message', 'Success to create new category!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $sanitize = [
            'nameForUpdate' => strip_tags($request->input('nameForUpdate'))
        ];

        $credential = Validator::make($sanitize, [
            'nameForUpdate' => [
                'required',
                'string',
                Rule::unique('categories', 'name')->ignore($category->id),
            ]
        ])->validate();

        $update = $category->update(['name' => $credential['nameForUpdate']]);
        if (!$update) {
            return redirect()->back()->withErrors('error', 'Failed to update category!')->withInput();
        }

        return redirect()->back()->with('message', 'Success to update category!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
