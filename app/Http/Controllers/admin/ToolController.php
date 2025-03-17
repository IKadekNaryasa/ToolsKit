<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\MntTool;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.tool.index', [
            'active' => 'master',
            'open' => 'tool',
            'link' => 'Tool | '
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
    public function show(MntTool $mntTool)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MntTool $mntTool)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MntTool $mntTool)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MntTool $mntTool)
    {
        //
    }
}
