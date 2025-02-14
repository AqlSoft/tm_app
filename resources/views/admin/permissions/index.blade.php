@extends('admin.layouts.app')

@section('content')
<style>
    form .input-group >input.form-control,
    form .input-group >select.form-control,
    form .input-group >select.form-control option,
    form .input-group >select.form-select option,
    form .input-group >button.form-control,
    form .input-group >button.input-group-text,
    form .input-group >label.input-group-text
    {
        height: 36px;
    }
</style>
<div class="container">
    <div class="view-main-heading d-flex">
        <h1 style="flex:auto">{{__('roles.roles')}}</h1>
        <a href="{{route('admin-roles-create')}}" 
        data-bs-toggle="modal" data-bs-target="#addRoleModal" 
        class="btn mb-3 btn-sm btn-outline-primary"><i class="fa fa-plus"></i> {{__('roles.create')}}</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>{{__('roles.id')}}</th>
                <th>{{__('roles.name')}}</th>
                <th>{{__('roles.description')}}</th>
                <th>{{__('roles.actions')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->description }}</td>
                <td>
                    <a href="{{route('admin-roles-edit', $role->id)}}" class="btn btn-sm py-0 btn-outline-primary">{{__('roles.edit')}}</a>
                    <form action="{{route('admin-roles-destroy', $role->id)}}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm py-0 btn-outline-danger">{{__('roles.delete')}}</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="modals">
   
    <div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin-roles-store') }}" method="POST">
                    <div class="modal-header py-1 px-3 d-flex">
                        <h1 class="fs-5 me-auto" style="flex:auto" id="addRoleModalLabel">{{__('roles.create_form_modal_title')}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="input-group mb-2">
                            <label class="input-group-text" for="name">{{__('roles.name')}}</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="input-group">
                            <label class="input-group-text" for="description">{{__('roles.description')}}</label>
                            <input type="text" name="description" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="input-group">
                            <button type="button" class="form-control btn btn-outline-secondary" data-bs-dismiss="modal">{{__('roles.close')}}</button>
                            <button type="submit" class="form-control btn btn-outline-success">{{__('roles.create')}}</button>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
      </div>
      
</div>
@endsection
