@extends('admin.layouts.app')

@section('content')

<div class="container">
    <div class="view-main-heading d-flex">
        <h1 style="flex:auto">{{__('clients.clients_list_heading')}}</h1>
        <a href="{{route('admin-clients-create')}}" 
        data-bs-toggle="modal" data-bs-target="#addClientModal" 
        class="btn mb-3 btn-sm btn-outline-primary"><i class="fa fa-plus"></i> {{__('clients.create')}}</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>{{__('clients.mobile_number')}}</th>
                <th>{{__('clients.name')}}</th>
                <th>{{__('clients.s_number')}}</th>
                <th>{{__('clients.city')}}</th>
                <th>{{__('clients.actions')}}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clients as $client)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $client->mobile}}</td>
                <td>{{ $client->getNameAttribute() }}</td>
                <td>{{ $client->s_number }}</td>
                <td>{{ $client->city }}</td>
                <td>
                    <a href="{{route('admin-clients-show', $client->id)}}" class="btn btn-sm py-0 btn-outline-success"><i class="fa fa-eye"></i> &nbsp;{{__('clients.show')}}</a>
                    <a href="{{route('admin-clients-edit', $client->id)}}" class="btn btn-sm py-0 btn-outline-primary"><i class="fa fa-edit"></i> &nbsp;{{__('clients.edit')}}</a>
                    <form action="{{route('admin-clients-destroy', $client->id)}}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm py-0 btn-outline-danger"><i class="fa fa-trash"></i> &nbsp;{{__('clients.delete')}}</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">{{__('clients.no_clients_yet')}}</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div id="modals">
   
    <div class="modal fade m-auto" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="width: 700px;">
                <form action="{{ route('admin-clients-store') }}" method="POST">
                    <div class="modal-header py-3 bg-light px-4 d-flex">
                        <h1 class="fs-5 me-auto" style="flex:auto" id="addClientModalLabel">{{__('clients.create_form_modal_title')}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        
                         
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fa fa-language"></i> <span class="text-danger">*</span></span>
                            <input type="text" name="name_ar" class="form-control" placeholder="{{__('clients.name_ar')}}" value="{{old('name_ar')}}" required>
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fa fa-language"></i> <span class="text-danger">*</span></span>
                            <input type="text" name="name_en" class="form-control" placeholder="{{__('clients.name_en')}}" value="{{old('name_en')}}" required>
                        </div>
                            
                        <!-- معلومات الهوية -->
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa fa-user-tag"></i> <span class="text-danger">*</span></span>
                            <select name="type" class="form-control" required>
                                <option hidden>{{__('clients.select_client_type')}}</option>
                                @foreach ($types as $item => $type)
                                    <option value="{{$item}}" {{old('type') == $item ? 'selected' : ''}}>{{__('clients.' . $type)}}</option>
                                @endforeach
                            </select>
                        
                            <span class="input-group-text"><i class="fa fa-id-card"></i> <i class="fa fa-user-card"></i></span>
                            <input type="text" name="identity_number" class="form-control" placeholder="{{__('clients.identity_number')}}" value="{{old('identity_number')}}" required>
                        </div>
                        
                        <!-- المعلومات المالية -->
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                            <input type="text" name="commercial_record" class="form-control" placeholder="{{__('clients.commercial_record')}}" value="{{old('commercial_record')}}">
                        
                            <span class="input-group-text"><i class="fa fa-money-bill"></i></span>
                            <input type="text" name="tax_number" class="form-control" placeholder="{{__('clients.tax_number')}}" value="{{old('tax_number')}}">
                        </div>
                    
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa fa-trademark"></i></span>
                            <input type="text" name="brand_name" class="form-control" placeholder="{{__('clients.brand_name')}}" value="{{old('brand_name')}}">
                        
                            <span class="input-group-text "><i class="fa fa-sort-numeric-asc"></i></span>
                            <input type="button" class="form-control" value="{{$s_number}}">
                        </div>
                            
                        <!-- معلومات الاتصال -->
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fa fa-phone"></i></span>
                            <input type="text" name="phone" class="form-control" placeholder="{{__('clients.phone_number')}}" value="{{old('phone')}}">
                        
                            <span class="input-group-text"><i class="fa fa-mobile"></i> <span class="text-danger">*</span></span>
                            <input type="text" name="mobile" class="form-control" required placeholder="{{__('clients.mobile_number')}}" value="{{old('mobile')}}">
                        </div>
                    
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fa fa-at"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="{{__('clients.email')}}" value="{{old('email')}}">
                        
                            <span class="input-group-text"><i class="fa fa-globe"></i></span>
                            <input type="url" name="website" class="form-control" placeholder="{{__('clients.website')}}" value="{{old('website')}}">
                        </div>
                           
        
                        <!-- الموقع الجغرافي -->
                        
                    
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                            <input type="text" name="city" class="form-control" placeholder="{{__('clients.city')}}" value="{{old('city')}}">
                        
                            <span class="input-group-text"><i class="fa fa-location-dot"></i></span>
                            <input type="text" name="address" class="form-control" placeholder="{{__('clients.address')}}" value="{{old('address')}}">
                        </div>
                            
        
                        <!-- معلومات إضافية -->
                        <div class="row mb-4">
                            <div class="col-md-8">
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fa fa-pen-to-square"></i></span>
                                    <input type="text" name="notes" class="form-control" placeholder="{{__('clients.notes')}}" value="{{old('notes')}}">
                                </div>
                            </div>
        
                            <div class="col-md-4">
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                                    <label class="form-check-label">{{__('clients.is_active')}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer py-2 bg-light">
                        <div class="input-group">
                            <button type="button" class="form-control btn btn-outline-secondary" data-bs-dismiss="modal">{{__('roles.close')}}</button>
                            <button type="submit" class="form-control btn btn-outline-success">{{__('roles.create')}}</button>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
      
</div>
@endsection
