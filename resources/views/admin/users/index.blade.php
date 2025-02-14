@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="view-main-heading d-flex mb-3">
        <h1 style="flex:auto">{{__('users.users_list_heading')}}</h1>
        <button class="btn py-0 btn-outline-primary" 
        data-bs-toggle="modal" data-bs-target="#addUserModal"> <i class="fa fa-plus"></i> {{__('users.create')}}</button>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>{{__('users.id')}}</th>
                <th>{{__('users.name')}}</th>
                <th>{{__('users.email')}}</th>
                <th>{{__('users.roles')}}</th>
                <th>{{__('users.actions')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->roles->pluck('name')->implode(', ') }}</td>
                <td>
                    <a href="{{ route('admin-users-edit', $user->id) }}" class="btn btn-sm py-0 btn-outline-primary"> <i class="fa fa-pencil"></i>  {{__('users.edit')}}</a>
                    <form action="{{ route('admin-users-destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm py-0 btn-outline-danger"><i class="fa fa-trash"></i> {{__('users.delete')}}</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<div id="modals">
   
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin-users-store') }}" method="POST">
                    <div class="modal-header py-1 px-3 d-flex">
                        <h1 class="fs-5 me-auto" style="flex:auto" id="addUserModalLabel">{{__('users.create_form_modal_title')}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="input-group mb-2">
                            <label class="input-group-text" for="name">{{__('users.name')}}</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="input-group mb-2">
                            <label class="input-group-text" for="email">{{__('users.email')}}</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="input-group mb-2">
                            <label class="input-group-text" for="password">{{__('users.password')}}</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="input-group mb-2">
                            <label class="input-group-text" for="password_confirmation">{{__('users.confirm_password')}}</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="input-group">
                            <button type="button" class="form-control btn btn-outline-secondary" data-bs-dismiss="modal">{{__('users.close')}}</button>
                            <button type="submit" class="form-control btn btn-outline-success">{{__('users.create')}}</button>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
      </div>
      
</div>
@endsection