<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $members = User::all();
        $team_members_roles = ['Technical', 'Team Leader', 'Worker', 'Project Manager', 'Engineer', 'Purchaces'];
        $teams = Team::all();
        return view('admin.teams.index', compact('teams', 'members', 'team_members_roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $team_code = Team::generateTeamCode();
        $members = User::where([])->get();
        return view('admin.teams.create', compact('members', 'team_code'));
    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'brief' => 'nullable|string',
            'leader_id' => 'required|exists:users,id',
            'code' => 'required|string|max:14',
        ]);

        try {
            // بدء المعاملة
            DB::beginTransaction();

            // إنشاء الفريق
            $validated['created_by'] = auth()->id();
            $validated['updated_by'] = auth()->id();
            $validated['s_number'] = Team::generateTeamCode();
            $team = Team::create($validated);

            // إضافة قائد الفريق
            TeamMember::create([
                'team_id' => $team->id,
                'member_id' => $validated['leader_id'],
                'role' => 1, // دور قائد الفريق
                'status' => 1, // حالة نشط
                'created_by' => auth()->id(),
                'updated_by' => auth()->id()
            ]);

            // تأكيد المعاملة
            DB::commit();

            return redirect()->route('admin-teams-index')
                ->with('success', __('teams.created_successfully'));

        } catch (\Exception $e) {
            // التراجع عن المعاملة في حالة حدوث خطأ
            DB::rollBack();
            
            return redirect()->back()
                ->withInput()
                ->with('error', __('teams.creation_failed') . ': ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        //
    }

    /**
     * Team Members Functions
     * Add member to team.
     */
    public function add_member(Request $request)
    {
        //
        $validated = $request->validate([
            'team_id' => 'required|exists:teams,id',
            'member_id' => 'required|exists:users,id',
            'role' => 'required',
        ]);

        try {
            $validated['created_by'] = auth()->id();
            $validated['updated_by'] = auth()->id();
            $validated['status'] = 0;
            TeamMember::create($validated);
            return redirect()->back()->with('success', __('teams.team_member_added_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('teams.team_member_added_fail' . ': ' . $e->getMessage()));
        }
    }
}
