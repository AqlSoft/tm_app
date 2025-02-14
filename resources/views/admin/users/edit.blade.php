@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="view-main-heading d-flex">
        <h1 style="flex:auto">{{__('users.edit_user_title')}}</h1>
        <a href="{{route('admin-users-index')}}" 
        class="btn mb-3 btn-sm btn-outline-primary"><i class="fa fa-home"></i> {{__('users.back')}}</a>
    </div>
    

    <form action="{{ route('admin-users-update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- بيانات المستخدم الأساسية -->
        <div class="card mb-4">
            <div class="card-header py-2 px-3">{{__('users.basic_info')}}</div>
            <div class="card-body">
                <div class="input-group mb-2">
                    <label class="input-group-text">{{__('users.name')}}</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                </div>

                <div class="input-group mb-2">
                    <label class="input-group-text">{{__('users.email')}}</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                </div>
            </div>
        </div>

        <!-- بيانات الملف الشخصي -->
        <div class="card mb-4">
            <div class="card-header py-2 px-3">{{__('users.personal_info')}}</div>
            <div class="card-body">
                
                <div class="input-group mb-2">
                    <label class="input-group-text">{{__('users.first_name')}}</label>
                    <input type="text" name="first_name" class="form-control" 
                            value="{{ old('first_name', optional($user->profile)->first_name) }}">
                
                    <label class="input-group-text">{{__('users.last_name')}}</label>
                    <input type="text" name="last_name" class="form-control" 
                            value="{{ old('last_name', optional($user->profile)->last_name) }}">
                </div>
                    

                <div class="input-group mb-2">
                    <label class="input-group-text">{{__('users.gender')}}</label>
                    <select name="gender" class="form-control">
                        <option value="">-- {{__('users.select')}} --</option>
                        <option value="male" @selected(old('gender', optional($user->profile)->gender) == 'male')>{{__('users.male')}}</option>
                        <option value="female" @selected(old('gender', optional($user->profile)->gender) == 'female')>{{__('users.female')}}</option>
                        <option value="other" @selected(old('gender', optional($user->profile)->gender) == 'other')>{{__('users.other')}}</option>
                    </select>
                
                    <label class="input-group-text">{{__('users.job_title')}}</label>
                    <select type="text" name="job_title" class="form-control" 
                           value="{{ old('job_title', optional($user->profile)->job_title) }}">
                        <option value="">-- {{__('users.select')}} --</option>
                        @foreach ($jobs as $key => $title)
                            <option value="{{ $key }}" @selected(old('job_title', optional($user->profile)->job_title) == $key)>{{ __('users.' . $title) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{__('users.update')}}</button>
    </form>
</div>
@endsection