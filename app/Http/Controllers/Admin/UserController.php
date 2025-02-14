<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            
        ]);
        $validated['password'] = Hash::make($validated['password']);
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();
        
        try {
            User::create($validated);
            return Redirect::back()
            ->with('success', __('users.created_successfully'));
        } catch (\Exception $e) {
            return Redirect::back()->with('error', __('users.create_failed' . ': ' . $e->getMessage()));
        }
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $jobs = User::$jobs_titles;
        return view('admin.users.edit', compact('user', 'roles', 'jobs'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'roles' => 'required|array|exists:roles,id'
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);
        $user->roles()->sync($validated['roles']);

        return redirect()->route('admin.users.index')
            ->with('success', 'تم تحديث المستخدم بنجاح');
    }

    public function show() {
        
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->user()->id) {
            return back()->with('error', __('users.cannot_delete_own_account'));
        }

        try {
            $user->delete();
            return Redirect::back()
                ->with('success', __('users.deleted_successfully'));
        } catch (\Exception $e) {
            return Redirect::back()->with('error', __('users.delete_failed') . ': ' . $e->getMessage());
        }

    }
}