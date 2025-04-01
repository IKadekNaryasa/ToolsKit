<?php

namespace App\Http\Controllers\admin;

use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tool;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maintenances = Maintenance::with('tool')->orderBy('created_at', 'desc')->get();
        return view('admin.maintenance.index', [
            'active' => 'maintenance',
            'open' => 'maintenance',
            'link' => 'maintenance | ',
            'maintenances' => $maintenances
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
    public function show(Maintenance $maintenance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maintenance $maintenance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Maintenance $maintenance)
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
            return redirect()->route('admin.repair.index')->withErrors($credential)->with(['errorFrom' => 'update'])->withInput($request->all() + ['id' => $maintenance->id]);
        }

        $validatedData = $credential->validate();
        DB::transaction(function () use ($validatedData, $maintenance) {
            $maintenance->update([
                'completion_date' => $validatedData['date'],
                'status' => $validatedData['status'],
                'cost' => $validatedData['cost'],
                'description' => $validatedData['notes']
            ]);

            if ($validatedData['status'] === 'done') {
                $tool = Tool::find($maintenance->tool_code);
                $tool->update(['status' => 'available']);
            }
        });
        return redirect()->route('admin.maintenance.index')->with('message', 'success to confim maintenance!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maintenance $maintenance)
    {
        //
    }
}
