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
            <label for="name_ar" class="input-group-text" data-bs-toggle="tooltip" data-bs-title="{{__('clients.name_ar')}}"><i class="fa fa-language"></i> <span class="text-danger">*</span></label>
            <input type="text" id="name_ar" name="name_ar" class="form-control" placeholder="{{__('clients.name_ar')}}" value="{{old('name_ar', $client->name_ar)}}" required>
        </div>
        <div class="input-group mb-2">
            <label for="name_en" class="input-group-text" data-bs-toggle="tooltip" data-bs-title="{{__('clients.name_en')}}"><i class="fa fa-language"></i> <span class="text-danger">*</span></label>
            <input type="text" id="name_en" name="name_en" class="form-control" placeholder="{{__('clients.name_en')}}" value="{{old('name_en', $client->name_en)}}" required>
        </div>
            
        <!-- معلومات الهوية -->
        <div class="input-group mb-3">
            <label for="type"  class="input-group-text"><i class="fa fa-user-tag"></i> <span class="text-danger">*</span></label>
            <select name="type" id="type" class="form-control" required>
                <option hidden>{{__('clients.select_client_type')}}</option>
                @foreach ($types as $type)
                    <option value="{{$type}}" {{$client->type == $type ? 'selected' : ''}}>{{__( 'clients.' . $type)}}</option>
                @endforeach
            </select>
        
            <label for="identity_number" class="input-group-text"><i class="fa fa-id-card"></i> <i class="fa fa-user-card"></i></label>
            <input type="text" id="identity_number" name="identity_number" class="form-control" placeholder="{{__('clients.identity_number')}}" value="{{old('identity_number', $client->identity_number)}}" required>
        </div>
        
        <!-- المعلومات المالية -->
        <div class="input-group mb-3">
            <label for="commercial_record" class="input-group-text"><i class="fa fa-credit-card"></i></label>
            <input type="text" id="commercial_record" name="commercial_record" class="form-control" placeholder="{{__('clients.commercial_record')}}" value="{{old('commercial_record', $client->commercial_record)}}">
        
            <label for="tax_number" class="input-group-text"><i class="fa fa-money-bill"></i></label>
            <input type="text" id="tax_number" name="tax_number" class="form-control" placeholder="{{__('clients.tax_number')}}" value="{{old('tax_number', $client->tax_number)}}">
        </div>
    
        <div class="input-group mb-3">
            <label for="brand_name" class="input-group-text"><i class="fa fa-trademark"></i></label>
            <input type="text" id="brand_name" name="brand_name" class="form-control" placeholder="{{__('clients.brand_name')}}" value="{{old('brand_name', $client->brand_name)}}">
        
            <span class="input-group-text "><i class="fa fa-sort-numeric-asc"></i></span>
            <input type="button" class="form-control" value="{{old('s_number', $client->s_number)}}">
        </div>
            
        <!-- معلومات الاتصال -->
        <div class="input-group mb-2">
            <label for="phone" class="input-group-text"><i class="fa fa-phone"></i></label>
            <input type="text" id="phone" name="phone" class="form-control" placeholder="{{__('clients.phone_number')}}" value="{{old('phone', $client->phone)}}">
        
            <label for="mobile" class="input-group-text"><i class="fa fa-mobile"></i> <span class="text-danger">*</span></label>
            <input type="text" id="mobile" name="mobile" class="form-control" required placeholder="{{__('clients.mobile_number')}}" value="{{old('mobile', $client->mobile)}}">
        </div>
    
        <div class="input-group mb-2">
            <label for="email" class="input-group-text"><i class="fa fa-at"></i></label>
            <input type="email" id="email" name="email" class="form-control" placeholder="{{__('clients.email')}}" value="{{old('email', $client->email)}}">
        
            <label for="website" class="input-group-text"><i class="fa fa-globe"></i></label>
            <input type="url" id="website" name="website" class="form-control" placeholder="{{__('clients.website')}}" value="{{old('website', $client->website)}}">
        </div>
            

        <!-- الموقع الجغرافي -->
        
    
        <div class="input-group mb-3">
            <label for="city" class="input-group-text"><i class="fa fa-map-marker"></i></label>
            <input type="text" id="city" name="city" class="form-control" placeholder="{{__('clients.city')}}" value="{{old('city', $client->city)}}">
        
            <label for="address" class="input-group-text"><i class="fa fa-location-dot"></i></label>
            <input type="text" id="address" name="address" class="form-control" placeholder="{{__('clients.address')}}" value="{{old('address', $client->address)}}">
        </div>
            

        <!-- معلومات إضافية -->
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="input-group mb-3">
                    <label for="notes" class="input-group-text"><i class="fa fa-pen-to-square"></i></label>
                    <input type="text" id="notes" name="notes" class="form-control" placeholder="{{__('clients.notes')}}" value="{{old('notes', $client->notes)}}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-check form-switch mt-2">
                    <input class="form-check-input" id="is_active" type="checkbox" name="is_active" value="1" {{ $client->is_active ? 'checked' : '' }}>
                    <label for="is_active" class="form-check-label">{{__('clients.is_active')}}</label>
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
