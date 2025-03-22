<?php

namespace App\Http\Controllers;

use App\Models\Operation;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        //
        $project = Project::find($id);

        $newOrder = $project->lastOperationOrder();
        $projects = Project::all();
        $supervisors = User::all();
        $gen_serial_number = Operation::generateSerialNumber($project);
        $order = Operation::getLastOperationOrder($project);
        return view('admin.projects.operations.create', compact('project', 'projects', 'gen_serial_number', 'order', 'supervisors', 'newOrder'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
        $validated = $request->validate([
            'project_id'        => 'required|exists:projects,id',
            's_number'          => 'required|unique:operations,s_number',
            'name'              => 'required|string|max:50',
            'order'             => 'required|numeric',
            'description'       => 'nullable|string|max:255',
            'supervisor_id'     => 'required|exists:users,id',
            'starts_at'         => 'required|date',
            'deadline'          => 'nullable|date|after:start_date',
        ]);
        

        $validated['created_by'] = auth()->user()->id;
        $validated['updated_by'] = auth()->user()->id;

        try {
            Operation::create($validated);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('operations.create_failed' . ': ' . $e->getMessage()));
        }

        return redirect()->back()->with('success', __('operations.created_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * Display the specified resource.
     */
    public function show(Operation $operation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Operation $operation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Operation $operation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Operation $operation)
    {
        //
    }
}
