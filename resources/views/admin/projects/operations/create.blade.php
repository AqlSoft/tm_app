@extends('admin.layouts.app')

@section('content')
<div class="container">
    <fieldset class="border p-3 rounded">

        <legend class="w-auto py-2 rounded">Add New Operation</legend>
        <h5 class="mt-3">Adding new operation for project: {{ $project->name }}</h5>
        <h6 class="mb-3">Serial Number: {{ $project->s_number }}</h6>
        <form class="mt-4" action="{{ route('admin-operations-store') }}" method="POST">
            @csrf
            <input type="hidden" name="project_id" value="{{ $project->id }}">
            <div class="input-group mb-2">
                <label class="input-group-text" for="name">Operation Name</label>
                <input type="text" name="name" class="form-control" required>
                <label class="input-group-text">Order</label>
                <label class="input-group-text">{{$order}}</label>
                <label class="input-group-text">Serial Number</label>
                <label class="input-group-text">{{$gen_serial_number}}</label>
            </div>
            <div class="input-group mb-2">
                <label class="input-group-text" for="description">Description</label>
                <input type="text" name="description" class="form-control">
            </div>
            <div class="input-group mb-2">
                <label class="input-group-text" for="starts_at">Starts At</label>
                <input type="date" id="starts_at" name="starts_at" class="form-control" >
            
                <label class="input-group-text" for="ends_at">Deadline</label>
                <input type="date" id="deadline" name="deadline" class="form-control">
            </div>
            <div class="input-group mb-2">
                <label class="input-group-text" for="supervisor">Supervisor</label>
                <select name="supervisor_id" id="supervisor" class="form-control">
                    <option value="">Select Supervisor</option>
                    @foreach ($supervisors as $supervisor)
                        <option value="{{ $supervisor->id }}">{{ $supervisor->name }} - {{$supervisor->profile->job_title}}</option>
                    @endforeach
                </select>
                <button type="submit" class="form-control btn btn-outline-primary" style="height: 36px">
                    <i class="fa fa-save"></i> Save Operation</button>
            </div>
        </form>
    </fieldset>
</div>

@endsection