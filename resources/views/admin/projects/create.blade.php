@extends('admin.layouts.app')
@section('header-breadcrumb')
     / <a href="{{ route('admin-projects-index') }}">{{__('Clients List')}}</a>
     / <a href="{{ route('admin-clients-projects-index' , $client->id) }}">{{__('Projects List')}}</a>
     / <div class="breadcrumb-item active">{{__('Create New')}}</div>
@endsection

@section('content')

<div class="container">
    <fieldset class="">
        <legend class="">{{__('create_new_project')}}</legend>
        <form class="mx-3 mb-3" action="{{ route('admin-projects-store') }}" method="POST">
        @csrf

        <input type="hidden" name="client_id" value="{{ $client->id }}">

        <div class="input-group mb-2">
            <label class="input-group-text" for="client_id">{{__('Client')}}</label>
            <input type="button" class="form-control" value="{{ $client->name . ' - SN: ' . $client->s_number . ' - Addr: ' . $client->address }}">
        </div>

        <div class="input-group mb-2">
            <label class="input-group-text" for="start_date">{{__('Starts In')}}</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="{{old('start_date')}}" required>
            <label class="input-group-text" for="period">{{__('Expected End In')}}</label>
            <input type="number" class="form-control" id="period" name="period" value="{{old('period')}}" required>
            <select class="form-control" id="time_unit" name="time_unit">
                <option hidden>{{__('Select Time Unit')}}</option>
                <option value="hours">  {{__('Hours')}} </option>
                <option value="days">   {{__('Days')}}  </option>
                <option value="weeks">  {{__('Weeks')}} </option>
                <option value="months"> {{__('Months')}}</option>
                <option value="years">  {{__('Years')}} </option>
            </select>
        </div>

        <fieldset class="bg-light mt-4">
            <legend class="" >{{__('Project Name')}} </legend>
            <div class="input-group mb-2 px-3">
                <input type="text" class="form-control" placeholder="{{__('Project Name Arabic')}}" id="name_ar" name="name_ar" value="{{old('name_ar')}}" required>
                <input type="text" class="form-control" placeholder="{{__('Project Name English')}}" id="name_en" name="name_en" value="{{old('name_en')}}" required>
            </div>
        </fieldset>

        <fieldset class="bg-light mt-4 mb-2">
            <legend class="" >{{__('Project Description')}} </legend>
            <div class="input-group mb-2 px-3">
                <textarea class="form-control" id="description_ar" placeholder="{{__('Projects Description Arabic')}}" name="description_ar">{{old('description_ar')}}</textarea>
                <textarea class="form-control" id="description_en" placeholder="{{__('Projects Description English')}}" name="description_en">{{old('description_en')}}</textarea>
            </div>
        </fieldset>

        <div class="input-group mb-2">
            <label class="input-group-text" for="project_type">{{__('Project Type')}}</label>
            <input type="text" class="form-control" id="project_type" name="project_type" value="{{old('project_type')}}">
        
            <label class="input-group-text" for="s_number">{{__('Serial Number')}}</label>
            <input type="button" class="form-control" id="s_number" name="s_number" value="{{$s_number}}">
        </div>

        <div class="input-group mb-2">
            <label class="input-group-text" for="project_manager">{{__('Project Manager')}}</label>
            <select class="form-control" id="project_manager" name="manager_id" required>
                <option hidden>{{__('Select Project Manager')}}</option>
                @foreach ($managers as $manager)
                    <option {{old('project_manager', '') == $manager->id ? 'selected' : ''}} value="{{ $manager->id }}">{{ $manager->name }}</option>
                @endforeach
            </select>

            <label class="input-group-text" for="status">{{__('Status')}}</label>
            <select class="form-control" id="status" name="status" required>
                <option hidden>{{__('Select Status')}}</option>
                <option {{old('status', '') == 'held' ? 'selected' : ''}} value="held">{{__('projects.held')}}</option>
                <option {{old('status', '') == 'tender' ? 'selected' : ''}} value="tender">{{__('projects.tender')}}</option></option>
                <option {{old('status', '') == 'ongoing' ? 'selected' : ''}} value="ongoing">{{__('projects.ongoing')}}</option>
                <option {{old('status', '') == 'finished' ? 'selected' : ''}} value="finished">{{__('projects.finished')}}</option>
                <option {{old('status', '') == 'pending' ? 'selected' : ''}} value="pending">{{__('projects.pending')}}</option>
            </select>
        </div>

        <div class="d-flex gap-2 justify-content-end">
            <a class="btn btn-outline-secondary py-0" href="{{route('admin-clients-index')}}">{{__('BAck To Clients')}}</a>
            <a class="btn btn-outline-secondary py-0" href="{{route('admin-projects-index')}}">{{__('Back To Projects')}}</a>
            <button type="submit" class="btn btn-outline-primary py-0">{{__('Add New Project')}}</button>
        </div>
    </form>
</fieldset>
</div>
@endsection

