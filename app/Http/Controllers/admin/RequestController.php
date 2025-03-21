<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ToolRequest;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = ToolRequest::with(['user', 'detail.category'])->get();
        // return $requests;
        return view('admin.request.index', [
            'active' => 'request',
            'open' => 'request',
            'link' => 'Request | ',
            'requests' => $requests
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
    public function store(ToolRequest $toolRequest)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ToolRequest $toolRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ToolRequest $toolRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $Request, ToolRequest $toolRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }
}
