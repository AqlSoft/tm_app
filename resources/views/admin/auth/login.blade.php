@extends('admin.layouts.auth')

@section('content')
<div class="login-container">
    <div class="login-form px-5">
        <div class="avatar">
            <img class="avatar-img" src="{{asset('assets/admin/images/logo.png')}}" alt="User Avatar">
        </div>
        <div class="form-space"></div>
        <form class="mt-5" method="POST" action="{{ route('login') }}">
            <h2 class="m-3 text-light fw-bold">تسجيل الدخول</h2>
            @csrf
            <div class="input-group mb-3">
                <label class="input-group-text" for="email">البريد الإلكتروني</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <label class="input-group-text" for="password">كلمة المرور</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="options">
                <div class="remember-me">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label text-light pe-2" for="remember">تذكرني</label>
                </div>
            </div>
            <a href="{{ route('password-request') }}" class="forgot-password">نسيت كلمة المرور؟</a>
            <button type="submit" class="btn btn-primary login-button">تسجيل الدخول</button>
        </form>
    </div>
</div>
@endsection
