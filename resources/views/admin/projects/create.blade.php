@extends('admin.layouts.app')

@section('content')

<div class="container">
    <fieldset class="border p-3 rounded">
        <legend class="w-auto py-1 rounded">إضافة مشروع جديد</legend>
        <form action="{{ route('admin-projects-store') }}" method="POST">
        @csrf
        <div class="input-group mb-2">
            <label class="input-group-text" for="client_id">العميل</label>
            <select class="form-control" id="client_id" name="client_id" required>
                @foreach($clients as $client)
                <option {{old('client_id', '') == $client->id ? 'selected' : ''}} value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-group mb-2">
            <label class="input-group-text" for="name_ar">اسم المشروع (بالعربية)</label>
            <input type="text" class="form-control" id="name_ar" name="name_ar" value="{{old('name_ar')}}" required>
        </div>
        <div class="input-group mb-2">
            <label class="input-group-text" for="name_en">اسم المشروع (بالإنجليزية)</label>
            <input type="text" class="form-control" id="name_en" name="name_en" value="{{old('name_en')}}" required>
        </div>
        <fieldset class="border mx-0 mt-4 mb-2 p-3 rounded">
            <legend class="input-group-text" for="description_ar">وصف المشروع</legend>
            <div class="input-group mt-2">
                <textarea class="form-control" id="description_ar" name="description_ar">{{old('description_ar')}}</textarea>
                <textarea class="form-control" id="description_en" name="description_en">{{old('description_en')}}</textarea>
            </div>
        </fieldset>
        <div class="input-group mb-2">
            <label class="input-group-text" for="start_date">تاريخ البدء</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="{{old('start_date')}}" required>
            <label class="input-group-text" for="end_date">تاريخ الانتهاء</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="{{old('end_date')}}">
        </div>
        <div class="input-group mb-2">
            <label class="input-group-text" for="status">الحالة</label>
            <select class="form-control" id="status" name="status" required>
                <option {{old('status', '') == 'held' ? 'selected' : ''}} value="held">تم تعليقه</option>
                <option {{old('status', '') == 'tender' ? 'selected' : ''}} value="tender">تحت الدراسة</option></option>
                <option {{old('status', '') == 'ongoing' ? 'selected' : ''}} value="ongoing">مشروع جاري</option>
                <option {{old('status', '') == 'ended' ? 'selected' : ''}} value="ended">مشروع مكتمل</option>
                <option {{old('status', '') == 'pending' ? 'selected' : ''}} value="pending">بانتظار الاعتماد</option>
            </select>
        </div>
        <div class="input-group mb-2">
            <label class="input-group-text" for="s_number">الرقم التسلسلي</label>
            <input type="text" class="form-control" id="s_number" name="s_number" vlaue="{{$s_number}}">
        </div>
        <div class="buttons justify-content-end">
            <button type="submit" class="btn btn-primary mt-3">إضافة المشروع</button>
            <a class="btn btn-primary mt-3" href="{{route('admin-clients-index')}}">{{__('projects.back_to_clients')}}</a>
            <a class="btn btn-primary mt-3" href="{{route('admin-projects-index')}}">{{__('projects.back_to_projects')}}</a>
        </div>
    </form>
</fieldset>
</div>
@endsection

