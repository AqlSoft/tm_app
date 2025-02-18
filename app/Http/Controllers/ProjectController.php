<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $projects = Project::paginate(10);
        $clients = Client::all();
        $types = Client::$types;
        $s_number = Project::generateSerialNumber();
        return view('admin.projects.index', compact('projects', 'clients', 'types', 's_number'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $s_number = Project::generateSerialNumber();
        return view('admin.projects.create', compact('clients', 's_number'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'name_ar' => 'required|string|max:255|unique:projects,name_ar',
            'name_en' => 'required|string|max:255|unique:projects,name_en',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'status' => 'nullable|in:tender,ongoing,finished,held,pending',
            's_number' => 'nullable|string|max:255|unique:projects,s_number',
        ]);

        $validated['created_by'] = auth()->user()->id;
        $validated['updated_by'] = auth()->user()->id;
        $validated['s_number'] = Project::generateSerialNumber();

        try {
            Project::create($validated);
            return Redirect::back()->with('success', __('project.created_successfully'));
        } catch (\Exception $e) {
            return Redirect::back()->with('error', __('project.create_failed' . ': ' . $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
        $statuses = Project::$statuses;
        return view('admin.projects.edit', compact('project', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $validated['updated_by'] = auth()->user()->id;

        try {
            $project->fill($validated);
            $project->update();
            return Redirect::back()->with('success', __('project.updated_successfully'));
        } catch (\Exception $e) {
            return Redirect::back()->with('error', __('project.update_failed' . ': ' . $e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
