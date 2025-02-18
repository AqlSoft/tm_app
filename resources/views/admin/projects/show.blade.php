@extends('admin.layouts.app')

@section('content')
<style>
.profile-props .prop-item {
    font-size: 14px;
    padding: 5px 10px;
}
</style>
<div class="container">
    <div class="row">

        <div class="col-md-6">
            <fieldset class="border p-3 rounded">
                <legend class="w-auto py-2 rounded">المشروع&nbsp;</legend>
                <div class="p-3 ">
                    <h5>اسم المشروع: {{ $project->name }}</h5>
                    <h5>الرقم المسلسل: {{ $project->s_number }}</h5>
                    <small>نبذة عن المشروع: {{ $project->description ?? 'لا يوجد وصف' }}</small><br>
                    <small>تاريخ البدء: {{ $project->start_date }}</small><br>
                    <small>تاريخ الانتهاء: {{ $project->end_date }}</small><br>
                    <small>الحالة: {{ $project->status }}</small>
                </div>
            </fieldset>
        </div>

        <div class="col-md-6">
            <fieldset class="border p-3 rounded">
                <legend class="w-auto py-2 rounded"> العميل </legend>
                <div class="p-3 ">
                    <h5>اسم العميل: {{ $project->client->name }}</h5>
                    <h5>الرقم المسلسل: {{ $project->client->s_number }}</h5>
                    <small>رقم الهاتف: {{ $project->client->phone }}</small><br>
                    <small>البريد الالكتروني: {{ $project->client->email }}</small><br>
                    <small>المدينة: {{ $project->client->city }}</small><br>
                    <small>العنوان: {{ $project->client->address }}</small>
                </div>
            </fieldset>
        </div>

        <div class="col-md-12">
            <fieldset class="border p-3 rounded">
                <legend class="w-auto py-2 rounded"> المهام &nbsp; 
                    <a href="{{ route('admin-tasks-create', [$project->id]) }}"> <i class="fa fa-plus text-primary"></i></a>
                </legend>
                <div class="p-3 ">
                    <h5>اسم العميل: {{ $project->client->name }}</h5>
                    <h5>الرقم المسلسل: {{ $project->client->s_number }}</h5>
                    <small>رقم الهاتف: {{ $project->client->phone }}</small><br>
                    <small>البريد الالكتروني: {{ $project->client->email }}</small><br>
                    <small>المدينة: {{ $project->client->city }}</small><br>
                    <small>العنوان: {{ $project->client->address }}</small>
                </div>
            </fieldset>
        </div>

        <div class="col-md-12">
            <fieldset class="border p-3 rounded">
                <legend class="w-auto py-2 rounded"> التوريدات &nbsp; 
                    <a href="{{ route('admin-tasks-create', $project->id) }}"> <i class="fa fa-plus text-primary"></i></a>
                </legend>
                <div class="p-3 ">
                    <h5>اسم العميل: {{ $project->client->name }}</h5>
                    <h5>الرقم المسلسل: {{ $project->client->s_number }}</h5>
                    <small>رقم الهاتف: {{ $project->client->phone }}</small><br>
                    <small>البريد الالكتروني: {{ $project->client->email }}</small><br>
                    <small>المدينة: {{ $project->client->city }}</small><br>
                    <small>العنوان: {{ $project->client->address }}</small>
                </div>
            </fieldset>
        </div>

        <div class="col-md-12">
            <fieldset class="border p-3 rounded">
                <legend class="w-auto py-2 rounded"> المدفوعات &nbsp; 
                    <a href="{{ route('admin-tasks-create', $project->id) }}"> <i class="fa fa-plus text-primary"></i></a>
                </legend>
                <div class="p-3 ">
                    <h5>اسم العميل: {{ $project->client->name }}</h5>
                    <h5>الرقم المسلسل: {{ $project->client->s_number }}</h5>
                    <small>رقم الهاتف: {{ $project->client->phone }}</small><br>
                    <small>البريد الالكتروني: {{ $project->client->email }}</small><br>
                    <small>المدينة: {{ $project->client->city }}</small><br>
                    <small>العنوان: {{ $project->client->address }}</small>
                </div>
            </fieldset>
        </div>

        <div class="col-md-12">
            <fieldset class="border p-3 rounded">
                <legend class="w-auto py-2 rounded"> الفواتير &nbsp; 
                    <a href="{{ route('admin-tasks-create', $project->id) }}"> <i class="fa fa-plus text-primary"></i></a>
                </legend>
                <div class="p-3 ">
                    <h5>اسم العميل: {{ $project->client->name }}</h5>
                    <h5>الرقم المسلسل: {{ $project->client->s_number }}</h5>
                    <small>رقم الهاتف: {{ $project->client->phone }}</small><br>
                    <small>البريد الالكتروني: {{ $project->client->email }}</small><br>
                    <small>المدينة: {{ $project->client->city }}</small><br>
                    <small>العنوان: {{ $project->client->address }}</small>
                </div>
            </fieldset>
        </div>
</div>
@endsection

@section('styles')
@if(app()->getLocale() === 'ar')
    <link rel="stylesheet" href="{{ asset('css/client-profile-rtl.css') }}">
@else
    <link rel="stylesheet" href="{{ asset('css/client-profile-ltr.css') }}">
@endif
@endsection
