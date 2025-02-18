<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['assignedUser', 'creator'])->paginate(10);
        return view('admin.tasks.index', compact('tasks'));
    }

    public function create($project_id)
    {
        $project = Project::findOrFail($project_id);
        $projects = Project::all();
        $teams = Team::all();
        $users = User::all();
        return view('admin.tasks.create', compact('project', 'projects', 'teams', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'assigned_to' => 'required|exists:users,id',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'due_date' => 'required|date|after:today',
        ]);

        $task = Task::create([
            ...$validated,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('admin.tasks.index')
            ->with('success', 'تم إنشاء المهمة بنجاح');
    }

    public function edit(Task $task)
    {
        $users = User::all();
        return view('admin.tasks.edit', compact('task', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'assigned_to' => 'required|exists:users,id',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'due_date' => 'required|date',
        ]);

        $task->update($validated);

        return redirect()->route('admin.tasks.index')
            ->with('success', 'تم تحديث المهمة بنجاح');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('admin.tasks.index')
            ->with('success', 'تم حذف المهمة بنجاح');
    }
}
