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
        $projects = Project::all();
        $supervisors = User::all();
        $gen_serial_number = Operation::generateSerialNumber($project);
        $order = Operation::getLastOperationOrder($project);
        return view('admin.projects.operations.create', compact('project', 'projects', 'gen_serial_number', 'order', 'supervisors'));
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
