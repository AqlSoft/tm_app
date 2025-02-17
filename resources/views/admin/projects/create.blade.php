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
                <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-group mb-2">
            <label class="input-group-text" for="name_ar">اسم المشروع (بالعربية)</label>
            <input type="text" class="form-control" id="name_ar" name="name_ar" required>
        </div>
        <div class="input-group mb-2">
            <label class="input-group-text" for="name_en">اسم المشروع (بالإنجليزية)</label>
            <input type="text" class="form-control" id="name_en" name="name_en" required>
        </div>
        <fieldset class="border mx-0 mt-4 mb-2 p-3 rounded">
            <legend class="input-group-text" for="description_ar">وصف المشروع</legend>
            <div class="input-group mt-2">
                <textarea class="form-control" id="description_ar" name="description_ar"></textarea>
                <textarea class="form-control" id="description_en" name="description_en"></textarea>
            </div>
        </fieldset>
        <div class="input-group mb-2">
            <label class="input-group-text" for="start_date">تاريخ البدء</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
            <label class="input-group-text" for="end_date">تاريخ الانتهاء</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
        </div>
        <div class="input-group mb-2">
            <label class="input-group-text" for="status">الحالة</label>
            <select class="form-control" id="status" name="status" required>
                <option value="held">تم تعليقه</option>
                <option value="tender">تحت الدراسة</option></option>
                <option value="ongoing">مشروع جاري</option>
                <option value="ended">مشروع مكتمل</option>
                <option value="pending">بانتظار الاعتماد</option>
            </select>
        </div>
        <div class="input-group mb-2">
            <label class="input-group-text" for="s_number">الرقم التسلسلي</label>
            <input type="text" class="form-control" id="s_number" name="s_number">
        </div>
        <button type="submit" class="btn btn-primary mt-3">إضافة المشروع</button>
    </form>
</fieldset>
</div>
@endsection

