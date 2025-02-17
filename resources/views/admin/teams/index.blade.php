@extends('admin.layouts.app')

@section('content')
<div class="container">
    <fieldset>

        <legend class="py-2 rounded">{{(__('teams.teams_list'))}}
            <a href="{{ route('admin-teams-create') }}" class=""> <i class="fa fa-plus"></i> {{__('teams.create_team')}}</a>
        </legend>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($teams as $team)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $team->getNameAttribute() }}</td>
                    <td>{{ $team->brief }}</td>
                    <td>
                        <a data-id="{{ $team->id }}" 
                            data-bs-toggle="modal" 
                            data-bs-target="#addTeamMemberForm" 
                            class="btn btn-sm btn-primary addTeamMemberBtn">add Member</a>
                        <a href="{{ route('admin-teams-show', $team->id) }}" class="btn btn-sm btn-success">Show</a>
                        <a href="{{ route('admin-teams-edit', $team->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin-teams-destroy', $team->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">{{__('teams.no_teams_yet')}}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </fieldset>
</div>

{{-- Modals --}}
<div class="modal fade m-auto" id="addTeamMemberForm" tabindex="-1" aria-labelledby="addTeamMemberFormLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 700px;">
            <form action="{{ route('admin-teams-add-member') }}" method="POST">
                <div class="modal-header py-3 bg-light px-4 d-flex">
                    <h1 class="fs-5 me-auto" style="flex:auto" id="addTeamMemberFormLabel">{{__('clients.create_form_modal_title')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="team_id" id="hidden_team_id" value="">
                    <div class="input-group mb-3">
                        <label for="team_member" class="input-group-text"><i class="fa fa-user"></i></label>
                        <select id="member" name="member_id" class="form-control" value="{{old('name')}}">
                            <option hidden>{{ __('teams.team_member_role_placeholder') }}</option>
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                                    {{ $member->name }}
                                </option>
                            @endforeach
                        </select>
                        <label for="role_id" class="input-group-text"><i class="fa fa-user-shield"></i></label>
                        <select id="role_id" name="role" class="form-control" value="{{old('role')}}">
                            <option hidden>{{ __('teams.team_member_role_placeholder') }}</option>
                            @foreach ($team_members_roles as $index => $role)
                                <option value="{{ $index }}" {{ old('role_id') == $index ? 'selected' : '' }}>
                                    {{ $role }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('teams.close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('teams.add_member')}}</button>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


@endsection

@section('footer_scripts')
<script>
    $(document).ready(function() {
        $('.addTeamMemberBtn').click(function() {
            var teamId = $(this).data('id');
            console.log(teamId)
            $('#hidden_team_id').val(teamId);
        });
    });
</script>
@endsection