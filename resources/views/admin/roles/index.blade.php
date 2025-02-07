@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Roles</h1>
    <a href="{{ route('admin-roles-create') }}" class="btn btn-primary">Add Role</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <a href="{{ route('admin-roles-edit', $role->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('admin-roles-destroy', $role->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
