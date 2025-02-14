@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="view-main-heading d-flex">
        <h1 style="flex:auto">{{__('roles.edit_role')}}</h1>
        <a href="{{route('admin-roles-index')}}" 
        class="btn mb-3 btn-sm btn-outline-primary"><i class="fa fa-home"></i> {{__('roles.back')}}</a>
    </div>
    <form action="{{ route('admin-roles-update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="input-group mb-2">
            <label class="input-group-text" for="name">{{__('roles.name')}}</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $role) }}" required>
        </div>
        <div class="input-group">
            <label class="input-group-text" for="description">{{__('roles.description')}}</label>
            <input type="text" name="description" class="form-control" value="{{ old('description', $role) }}" required>
        </div>
        <div class="d-flex justify-content-end pt-3">
            <button type="submit" class="btn py-1 btn-outline-primary"><i class="fa fa-save"></i> {{__('roles.update')}}</button>
        </div>
    </form>
</div>
@endsection
