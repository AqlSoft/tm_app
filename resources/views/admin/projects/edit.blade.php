@extends('admin.layouts.app')

@section('content')

<div class="container">
    <fieldset class="border p-3 rounded">
        <legend class="w-auto py-1 rounded">{{__('projects.edit_form_legend_title')}}</legend>
        <form class="pt-4" action="{{ route('admin-projects-update', $project->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="input-group mb-2">
            <label class="input-group-text" for="client_id">{{__('projects.client')}}</label>
            <select class="form-control" id="client_id" name="client_id" required>
                <option >{{ $project->client->name }}</option>
            </select>
        </div>
        <div class="input-group mb-2">
            <label class="input-group-text" for="name_ar">{{__('projects.name_ar')}}</label>
            <input type="text" class="form-control" id="name_ar" name="name_ar" value="{{old('name_ar', $project)}}" required>
        </div>
        <div class="input-group mb-2">
            <label class="input-group-text" for="name_en">{{__('projects.name_en')}}</label>
            <input type="text" class="form-control" id="name_en" name="name_en" value="{{old('name_en', $project)}}" required>
        </div>
        <fieldset class="border mx-0 mt-4 mb-2 p-3 rounded">
            <legend class="input-group-text" for="description_ar">{{__('projects.description')}}</legend>
            <div class="input-group mt-2">
                <textarea class="form-control" id="description_ar" name="description_ar">{{old('description_ar', $project)}}</textarea>
                <textarea class="form-control" id="description_en" name="description_en">{{old('description_en', $project)}}</textarea>
            </div>
        </fieldset>
        <div class="input-group mb-2">
            <label class="input-group-text" for="start_date">{{__('projects.start_date')}}</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="{{old('start_date', $project)}}" required>
            <label class="input-group-text" for="end_date">{{__('projects.end_date')}}</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="{{old('end_date', $project)}}" required>
        
            <label class="input-group-text" for="s_number">{{__('projects.s_number')}}</label>
            <input type="text" class="form-control" id="s_number" name="s_number" value="{{$project->s_number}}">
        </div>
        <div class="buttons justify-content-end">

            <button type="submit" class="btn btn-primary mt-3">{{__('projects.update')}}</button>
            <a class="btn btn-primary mt-3" href="{{route('admin-clients-show', $project->client->id)}}">{{__('projects.back_to_client')}}</a>
            <a class="btn btn-primary mt-3" href="{{route('admin-projects-index', $project->id)}}">{{__('projects.back_to_projects')}}</a>
        </div>
    </form>
</fieldset>
</div>
@endsection

