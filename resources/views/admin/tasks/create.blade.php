@extends('admin.layouts.app')

@section('content')
<div class="container">
    <fieldset class="border p-3 rounded">

        <legend class="w-auto py-2 rounded">Add New Mission</legend>
        <form class="mt-4" action="{{ route('admin-tasks-store') }}" method="POST">
            @csrf
            <div class="input-group mb-2">
                <label class="input-group-text" for="name">Mission Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="input-group mb-2">
                <label class="input-group-text" for="name">Project</label>
                <select name="project_id" class="form-control" required>
                    @foreach ($projects as $option)
                        <option {{old('project_id') == $option->id || $option->id == $project->id ? 'selected' : ''}} value="{{ $option->id }}">{{ $option->name }}</option>
                    @endforeach
                </select>
                <label class="input-group-text" for="name">Team</label>
                <select name="team_id" class="form-control" required>
                    @foreach ($teams as $team)
                        <option {{old('team_id') == $team->id ? 'selected' : ''}} value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex justify-content-end pt-3">
                <button type="submit" class="btn py-1 btn-outline-primary">
                    <i class="fa fa-save"></i> Save Mission</button>
            </div>
        </form>
    </fieldset>
</div>
@endsection