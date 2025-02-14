@extends('admin.layouts.app')

@section('content')

<style>
    input.form-control {
        color: #667eea !important; 
        font-weight: bold;
    }

    ::placeholder {
        color: #ccd1d4 !important;
        font-weight: normal;
    }
</style>
<div class="container">
    <div class="view-main-heading d-flex">
        <h1 style="flex:auto">{{__('clients.edit_client')}}</h1>
        <a href="{{route('admin-clients-index')}}" 
        class="btn mb-3 btn-sm btn-outline-primary"><i class="fa fa-home"></i> {{__('clients.back')}}</a>
    </div>
    <form action="{{ route('admin-clients-update', $client->id) }}" method="POST">
        @csrf
        @method('PUT')
            
        <div class="input-group mb-2">
            <span class="input-group-text"><i class="fa fa-language"></i> <span class="text-danger">*</span></span>
            <input type="text" name="name_ar" class="form-control" placeholder="{{__('clients.name_ar')}}" value="{{old('name_ar', $client)}}" required>
        </div>
        <div class="input-group mb-2">
            <span class="input-group-text"><i class="fa fa-language"></i> <span class="text-danger">*</span></span>
            <input type="text" name="name_en" class="form-control" placeholder="{{__('clients.name_en')}}" value="{{old('name_en', $client)}}" required>
        </div>
            
        <!-- معلومات الهوية -->
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa fa-user-tag"></i> <span class="text-danger">*</span></span>
            <select name="type" class="form-control" required>
                <option hidden>{{__('clients.select_client_type')}}</option>
                @foreach ($types as $type)
                    <option value="{{$type}}" {{$client->type == $type ? 'selected' : ''}}>{{__( 'clients.' . $type)}}</option>
                @endforeach
            </select>
        
            <span class="input-group-text"><i class="fa fa-id-card"></i> <i class="fa fa-user-card"></i></span>
            <input type="text" name="identity_number" class="form-control" placeholder="{{__('clients.identity_number')}}" value="{{old('identity_number', $client)}}" required>
        </div>
        
        <!-- المعلومات المالية -->
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
            <input type="text" name="commercial_record" class="form-control" placeholder="{{__('clients.commercial_record')}}" value="{{old('commercial_record', $client)}}">
        
            <span class="input-group-text"><i class="fa fa-money-bill"></i></span>
            <input type="text" name="tax_number" class="form-control" placeholder="{{__('clients.tax_number')}}" value="{{old('tax_number', $client)}}">
        </div>
    
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa fa-trademark"></i></span>
            <input type="text" name="brand_name" class="form-control" placeholder="{{__('clients.brand_name')}}" value="{{old('brand_name', $client)}}">
        
            <span class="input-group-text "><i class="fa fa-sort-numeric-asc"></i></span>
            <input type="button" class="form-control" value="{{old('s_number', $client)}}">
        </div>
            
        <!-- معلومات الاتصال -->
        <div class="input-group mb-2">
            <span class="input-group-text"><i class="fa fa-phone"></i></span>
            <input type="text" name="phone" class="form-control" placeholder="{{__('clients.phone_number')}}" value="{{old('phone', $client)}}">
        
            <span class="input-group-text"><i class="fa fa-mobile"></i> <span class="text-danger">*</span></span>
            <input type="text" name="mobile" class="form-control" required placeholder="{{__('clients.mobile_number')}}" value="{{old('mobile', $client)}}">
        </div>
    
        <div class="input-group mb-2">
            <span class="input-group-text"><i class="fa fa-at"></i></span>
            <input type="email" name="email" class="form-control" placeholder="{{__('clients.email')}}" value="{{old('email', $client)}}">
        
            <span class="input-group-text"><i class="fa fa-globe"></i></span>
            <input type="url" name="website" class="form-control" placeholder="{{__('clients.website')}}" value="{{old('website', $client)}}">
        </div>
            

        <!-- الموقع الجغرافي -->
        
    
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
            <input type="text" name="city" class="form-control" placeholder="{{__('clients.city')}}" value="{{old('city', $client)}}">
        
            <span class="input-group-text"><i class="fa fa-location-dot"></i></span>
            <input type="text" name="address" class="form-control" placeholder="{{__('clients.address')}}" value="{{old('address', $client)}}">
        </div>
            

        <!-- معلومات إضافية -->
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-pen-to-square"></i></span>
                    <input type="text" name="notes" class="form-control" placeholder="{{__('clients.notes')}}" value="{{old('notes', $client)}}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-check form-switch mt-2">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $client->is_active ? 'checked' : '' }}>
                    <label class="form-check-label">{{__('clients.is_active')}}</label>
                </div>
            </div>
        </div>
    
        <div class="input-group">
            <button type="button" class="form-control btn btn-outline-secondary" data-bs-dismiss="modal">{{__('roles.close')}}</button>
            <button type="submit" class="form-control btn btn-outline-success">{{__('roles.create')}}</button>
        </div>
    </form>
</div>
@endsection
