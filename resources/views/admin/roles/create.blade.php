@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Add Role</h1>
    <form action="{{ route('admin-roles-store') }}" method="POST">
        @csrf
        {{Session::get('locale')}} -- {{ __('home.add_role') }}

        <div class="form-group">
            <label for="name">Role Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Create Role</button>
    </form>
</div>
@endsection
