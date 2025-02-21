<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Redirect;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::where('is_public', true)
            ->orderBy('group')
            ->orderBy('key')
            ->paginate(20);
            
        return view('admin.settings.index', compact('settings'));
    }

    public function create()
    {
        return view('admin.settings.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'group' => 'required|string|max:255',
            'key' => 'required|string|max:255',
            'value' => 'required',
            'type' => 'required|string|in:string,boolean,integer,float,array',
            'scope' => 'required|string|in:global,user,role',
            'description' => 'nullable|string',
            'is_public' => 'boolean',
            'options' => 'nullable|json'
        ]);

        try {
            $validated['created_by'] = auth()->id();
            $validated['updated_by'] = auth()->id();
            
            Setting::create($validated);
            return redirect()->route('admin-settings-index')
                ->with('success', __('settings.created_successfully'));
        } catch (\Exception $e) {
            return back()->with('error', __('settings.create_failed') . ': ' . $e->getMessage());
        }
    }

    public function edit(Setting $setting)
    {
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $validated = $request->validate([
            'value' => 'required',
            'description' => 'nullable|string',
            'is_public' => 'boolean',
            'options' => 'nullable|json'
        ]);

        try {
            $validated['updated_by'] = auth()->id();
            $setting->update($validated);
            return back()->with('success', __('settings.updated_successfully'));
        } catch (\Exception $e) {
            return back()->with('error', __('settings.update_failed') . ': ' . $e->getMessage());
        }
    }

    public function destroy(Setting $setting)
    {
        try {
            $setting->delete();
            return back()->with('success', __('settings.deleted_successfully'));
        } catch (\Exception $e) {
            return back()->with('error', __('settings.delete_failed') . ': ' . $e->getMessage());
        }
    }

    public function group($group)
    {
        $settings = Setting::where('group', $group)
            ->where('is_public', true)
            ->orderBy('key')
            ->paginate(20);
            
        return view('admin.settings.group', compact('settings', 'group'));
    }
}
