<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

use App\Models\UserProfile;
use App\Models\Jobtitle;
use App\Models\User;
use App\Models\Role;

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
        $jobTitles = Jobtitle::where('status', 1)->get();
        return view('admin.users.edit', compact('user', 'roles', 'jobTitles'));
    }

    public function saveJobTitle(Request $request)
    {
        // 
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'required|string'
        ]);
        $validated['updated_by'] = auth()->id();
        $validated['created_by'] = auth()->id();

        try {
            Jobtitle::create($validated);
            return Redirect::back()->with('success', __('jobs.created_successfully'));
        } catch (\Exception $e) {
            return Redirect::back()->with('error', __('jobs.create_failed' . ': ' . $e->getMessage()));
        }
    }

    public function updateProfile(Request $request, User $user) {

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string',
            'job_title' => 'required|string',
        ]);
        $validated['updated_by'] = auth()->id();

        $profile = UserProfile::find($user->id);
        try {
            $profile->update($validated);
            return Redirect::back()->with('success', __('users.updated_successfully'));
        } catch (\Exception $e) {
            return Redirect::back()->with('error', __('users.update_failed' . ': ' . $e->getMessage()));
        }
    }
    public function changeProfileImage(Request $request, User $user) {

        // التحقق من الصورة
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // رفع الصورة إلى public/uploads/images
        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalExtension(); // اسم فريد
        $image->move(public_path('uploads/images'), $imageName);

        // حفظ المسار في قاعدة البيانات
        $validated['image'] = 'uploads/images/' . $imageName; // المسار النسبي
        $validated['updated_by'] = auth()->id();

        try {
            // تحديث الملف الشخصي
            $profile = UserProfile::updateOrCreate(
                ['user_id' => $user->id],
                $validated
            );

            return redirect()->back()->with('success', 'تم تحديث الملف الشخصي بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

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

    public function updateAccountInfo(Request $request, User $user) {
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $validated['updated_by'] = auth()->id();
        
        try {
            $user->update($validated);
            return redirect()->back()
                ->with('success', 'تم تحديث المستخدم بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ ما ، يرجى المحاولة مرة أخرى'. $e->getMessage());
        }
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