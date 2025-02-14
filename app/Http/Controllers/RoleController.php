<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:72|unique:roles',
            'description' => 'required|string|max:255',
        ]);
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        try {
            Role::create($validated);
            return Redirect::back()->with('success', __('roles.created_successfully'));
        } catch (\Exception $e) {
            return Redirect::back()->with('error', __('roles.create_failed' . ': ' . $e->getMessage()));
        }
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:72|unique:roles,name,'.$id,
            'description' => 'required|string|max:255',
        ]);
        $validated['updated_by'] = auth()->id();

        $role = Role::findOrFail($id);
        try {
            $role->update($validated);
                return Redirect::back()->with('success', __('roles.updated_successfully'));
        } catch (\Exception $e) {
            return Redirect::back()->with('error', __('roles.update_failed'));
        }
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        try {
            $role->delete();
            return Redirect::back()->with('success', __('roles.deleted_successfully'));
        } catch (\Exception $e) {
            return Redirect::back()->with('error', __('roles.delete_failed'));
        }
    }
}
