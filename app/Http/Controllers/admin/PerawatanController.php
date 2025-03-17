<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Perawatan;
use Illuminate\Http\Request;

class PerawatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.perawatan.index', [
            'active' => 'maintenance',
            'open' => 'perawatan',
            'link' => 'Perawatan | '
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
    public function show(Perawatan $perawatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Perawatan $perawatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Perawatan $perawatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Perawatan $perawatan)
    {
        //
    }
}
