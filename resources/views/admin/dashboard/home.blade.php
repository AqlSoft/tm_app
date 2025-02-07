@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">لوحة التحكم</h1>
    <ul>
        <li><a href="{{ route('admin-roles-index') }}">عرض الأدوار</a></li>
        <li><a href="{{ route('admin-roles-create') }}">إضافة دور جديد</a></li>
    </ul>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">المشاريع</div>
                <div class="card-body">
                    <p>عدد المشاريع: 10</p>
                    <a href="#" class="btn btn-primary">عرض المشاريع</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">المهام</div>
                <div class="card-body">
                    <p>عدد المهام: 25</p>
                    <a href="#" class="btn btn-primary">عرض المهام</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection