@extends('admin.layouts.app')

@section('header-breadcrumb')
<div class="breadcrumb-item"><a href="{{route('admin-users-index')}}">{{__('users.users_list_title')}}</a></div>
<div class="breadcrumb-item active" aria-current="page">{{__('users.edit_user_title')}}</div>
@endsection

@section('content')
<div class="container">
    
    <div class="row gap-0 align-items-start">
        <div class="col col-md-9 px-0">
            <fieldset class="rounded mb-4">
                <legend class="rounded py-1 px-3">{{__('account_info')}}</legend>
                <form action="{{ route('admin-users-update-account-info', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- بيانات المستخدم الأساسية -->
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
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-outline-primary btn-sm" type="submit"><i class="fa fa-save"></i> &nbsp; {{__('users.update')}}</button>
                    </div>
                </form>
            </fieldset>
        </div>
        {{-- users-change-profile-image --}}
        <div class="col col-md-3 px-0">
            <fieldset class="rounded mb-4 pt-3">
                <legend class="w-auto py-1 rounded">{{__('users.image')}}
                    <label for="profile_image"><i class="fa fa-upload"></i></label>
                </legend>
                <div class="row position-relative">
                    
                        <div class="text-center">
                            <label for="profile_image"><img id="profile_image_preview" style="width: 140px; height: 140px;"
                            src="{{ asset($user->profile->image ?? '/uploads/images/profile_default_icon.png') }}" 
                                alt="{{ $user->name }}" class="rounded-circle"></label>
                        </div>
                   
                        <form action="{{ route('admin-users-change-profile-image', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                                <input id="profile_image" style="display:none" type="file" name="image" class="form-control">
                                <button class="btn position-absolute btn-outline-primary btn-sm" type="submit"
                                style="left: 1rem; bottom: 0;"
                                ><i class="fa fa-save"></i> </button>

                        </form>
                    
                </div>
                
            </fieldset>
        </div>
    </div>

        <!-- بيانات الملف الشخصي -->
        <fieldset class="rounded mb-4 mx-0">
            <legend class="rounded py-1 px-3">{{__('personal_info')}}</legend>
            <form action="{{ route('admin-users-profile-update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
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
                        <option value="1" @selected(old('gender', optional($user->profile)->gender) == '1')>{{__('users.male')}}</option>
                        <option value="2" @selected(old('gender', optional($user->profile)->gender) == '2')>{{__('users.female')}}</option>
                        <option value="3" @selected(old('gender', optional($user->profile)->gender) == '3')>{{__('users.other')}}</option>
                    </select>
                
                    <label class="input-group-text">{{__('users.job_title')}}</label>
                    <label class="input-group-text btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_job_title_modal">
                        <i class="fas fa-plus"></i>
                    </label>
                    <select type="text" name="job_title" class="form-control" 
                            value="{{ old('job_title', optional($user->profile)->job_title) }}">
                        <option value="">-- {{__('users.select')}} --</option>
                        @foreach($jobTitles as $jobTitle)
                            <option value="{{ $jobTitle->id }}" 
                                {{ old('job_title', optional($user->profile)->job_title) == $jobTitle->id ? 'selected' : '' }}>
                                {{ $jobTitle->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-outline-primary btn-sm" type="submit"><i class="fa fa-save"></i> &nbsp; {{__('users.update')}}</button>
                </div>
            </form>
            
        </fieldset>

        <div class="row">
            <div class="col col-md-6 mx-0">
                <!-- تغير كلمة المرور -->
                <fieldset class="rounded mb-4">
                    <legend class="rounded py-1 px-3">{{__('change_password')}}</legend>
                    <form action="{{ route('admin-users-change-password', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="input-group mb-2">
                            <label class="input-group-text">{{__('users.old_password')}}</label>
                            <input type="password" name="old_password" class="form-control" 
                                    value="{{ old('old_password', optional($user->profile)->old_password) }}">
                        </div>
                        <div class="input-group mb-2">
                            <label class="input-group-text">{{__('users.new_password')}}</label>
                            <input type="password" name="password" class="form-control" 
                                    value="{{ old('password', optional($user->profile)->password) }}">
                        </div>
                        <div class="input-group mb-2">
                            <label class="input-group-text">{{__('users.confirm_new_password')}}</label>
                            <input type="password" name="password_confirmation" class="form-control" 
                                    value="{{ old('password_confirmation', optional($user->profile)->password_confirmation) }}">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-outline-primary btn-sm" type="submit"><i class="fa fa-save"></i> &nbsp; {{__('users.update')}}</button>
                        </div>
                    </form>
                    
                </fieldset>
            </div>
            
{{-- users-change-profile-image --}}

</div>

<div id="modals">
    <!-- Add Job Title Modal -->
    <div class="modal fade w-100" id="add_job_title_modal" tabindex="-1" aria-labelledby="add_job_title_modal_label" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 800px;">
            <div class="modal-content w-100">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_job_title_modal_label">{{__('users.add_job_title')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="add_job_title_form" action="{{ route('admin-users-add-job-title') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 input-group">
                            <label for="name_ar" class="input-group-text">{{__('users.job_title_name_ar')}}</label>
                            <input type="text" class="form-control" id="name_ar" name="name_ar" required>
                       
                            <label for="name_en" class="input-group-text">{{__('users.job_title_name_en')}}</label>
                            <input type="text" class="form-control" id="name_en" name="name_en" required>
                        </div>
                    
                        <div class="mb-3 input-group">
                            <label for="description_ar" class="input-group-text">{{__('users.job_title_description_ar')}}</label>
                            <input type="text" class="form-control" id="description_ar" name="description_ar" required>
                        </div>
                    
                        <div class="mb-3 input-group">
                            <label for="description_en" class="input-group-text">{{__('users.job_title_description_en')}}</label>
                            <input type="text" class="form-control" id="description_en" name="description_en" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('users.close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('users.save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput    = document.querySelector('#profile_image');
        const imagePreview  = document.getElementById('profile_image_preview');
        const allowedTypes  = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        const maxSize       = 10 * 1024 * 1024; // 10MB

        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            
            if (file) {
                // التحقق من نوع الملف
                if (!allowedTypes.includes(file.type)) {
                    alert('نوع الملف غير مسموح به. الأنواع المسموح بها هي: JPG, JPEG, PNG, GIF');
                    this.value = '';
                    return;
                }

                // التحقق من حجم الملف
                if (file.size > maxSize) {
                    alert('حجم الملف يجب أن لا يتجاوز 10 ميجابايت');
                    this.value = '';
                    return;
                }

                const reader = new FileReader();
                
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                }

                reader.onerror = function() {
                    alert('حدث خطأ أثناء قراءة الملف');
                    imagePreview.src = "{{ asset('storage/private/public/images/profile_default_icon.png') }}";
                }

                reader.readAsDataURL(file);
            } else {
                imagePreview.src = "{{ asset('storage/private/public/images/profile_default_icon.png') }}";
            }
        });
    });
</script>
@endsection