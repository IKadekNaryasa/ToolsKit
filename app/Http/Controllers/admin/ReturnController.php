<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Returns;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $returns = Returns::with(['admin', 'borrowing.detail'])->get();
        return view('admin.return.index', [
            'active' => 'transaction',
            'open' => 'return',
            'link' => 'return | ',
            'returns' => $returns
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
    public function show(Returns $returns)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Returns $returns)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Returns $returns)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Returns $returns)
    {
        //
    }
}
