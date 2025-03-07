@extends('admin.layouts.app')

@section('content')
<style>
.profile-props .prop-item {
    font-size: 14px;
    padding: 5px 10px;
}

.status-held {
    background-color: #ff3c00;
    color: #fff;
}
.status-tender {
    background-color: #8a8a8a;
    color: #fff;
}
.status-ongoing {
    background-color: #cb7df8;
    color: #fff;
}
.status-finished {
    background-color: #00ad48;
    color: #fff;
}
.status-pending {
    background-color: #88d4f1;
    color: #fff;
}
</style>
<div class="container">
    
    <div class="row">
        <div class="col-md-7 mx-0 p-1 mb-3">
            <fieldset class="border m-0 profile-props">
                <legend class="w-auto py-1 px-4 rounded">المعلومات الأساسية</legend>
                <div class="d-flex px-3">
                    <div class="" style="width: 90px">
                        @if($client->logo)
                            <img src="{{ asset('storage/' . $client->logo) }}" alt="شعار العميل" 
                            class="img-fluid rounded mb-3" style="width: 70px; height: 70px; object-fit: cover;">
                        @else
                            <div class="client-avatar" style="width: 70px; height: 70px; font-size: 2rem">
                                {{ substr($client->getNameAttribute(), 0, 2) }}
                            </div>
                        @endif
                    </div>
                    <div class="" style="width: 60%">
                        <p class="prop-item py-0 my-0 fs-6 fw-bold" id="full_name">{{ mb_substr($client->getNameAttribute(), 0, 20) }}</p>
                        <p class="prop-item py-0 my-0" id="city"><i class="fa fa-map-marker"></i> &nbsp;{{ $client->city }}</p>
                        <p class="prop-item py-0 my-0" id="address"><i class="fa fa-location-dot"></i> &nbsp;{{ $client->address }}</p>      
                    </div>
                    <div>
                        <span class="badge mb-2 rounded-pill bg-secondary text-light">عميل منذ: {{$client->created_at}}</span>
                        <span class="badge mb-2 rounded-pill bg-secondary text-light">مسلسل: {{$client->s_number}}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 ps-3 mb-3">
                        <p class="prop-item py-0 my-0" data-bs-toggle="tooltip" 
                            data-bs-title="{{__('clients.email')}}" id="email">
                            <i class="fa fa-at"></i> &nbsp;{{ $client->email ?? __('dashboard.not_assigned') }}</p>
                        <p class="prop-item py-0 my-0" data-bs-toggle="tooltip" 
                            data-bs-title="{{__('clients.brand_name')}}" id="brand_name">
                            <i class="fa fa-registered"></i> &nbsp;{{ $client->brand_name ?? __('dashboard.not_assigned') }}</p>
                        <p class="prop-item py-0 my-0" data-bs-toggle="tooltip" 
                            data-bs-title="{{__('clients.identity_number')}}" id="identity_number">
                            <i class="fa fa-id-card"></i> &nbsp;{{ $client->identity_number ?? __('dashboard.not_assigned') }}</p>
                        <p class="prop-item py-0 my-0" data-bs-toggle="tooltip" 
                            data-bs-title="{{__('clients.phone')}}" id="phone">
                            <i class="fa fa-phone"></i> &nbsp;{{ $client->phone ?? __('dashboard.not_assigned') }}</p>
                        <p class="prop-item py-0 my-0" data-bs-toggle="tooltip" 
                            data-bs-title="{{__('clients.whatsapp')}}" id="whatsapp">
                            <i class="fa-brands fa-whatsapp"></i> &nbsp;{{ $client->whatsapp ?? __('dashboard.not_assigned') }}</p>
                    </div>
                    <div class="col-md-6 ps-3 mb-3">
                        <p class="prop-item py-0 my-0" data-bs-toggle="tooltip" 
                            data-bs-title="{{__('clients.website')}}" id="website">
                            <i class="fa fa-globe"></i> &nbsp;{{ $client->website ?? __('dashboard.not_assigned') }}</p>
                        <p class="prop-item py-0 my-0" data-bs-toggle="tooltip" 
                            data-bs-title="{{__('clients.fax')}}" id="fax">
                            <i class="fa fa-fax"></i> &nbsp;{{ $client->fax ?? __('dashboard.not_assigned') }}</p>
                        <p class="prop-item py-0 my-0" data-bs-toggle="tooltip" 
                            data-bs-title="{{__('clients.commercial_record')}}" id="commercial_record">
                            <i class="fa fa-file-text"></i> &nbsp;{{ $client->commercial_record ?? __('dashboard.not_assigned') }}</p>
                        <p class="prop-item py-0 my-0" data-bs-toggle="tooltip" 
                            data-bs-title="{{__('clients.tax_number')}}" id="tax_number">
                            <i class="fa fa-receipt"></i> &nbsp;{{ $client->tax_number ?? __('dashboard.not_assigned') }}</p>
                        <p class="prop-item py-0 my-0" data-bs-toggle="tooltip" 
                            data-bs-title="{{__('clients.mobile_number')}}" id="mobile_number">
                            <i class="fa fa-mobile-screen "></i> &nbsp;{{ $client->mobile_number ?? __('dashboard.not_assigned') }}</p>
                    </div>
                </div>
            </fieldset>
        </div>

        <div class="col-md-5 mx-0 p-1 mb-3">
            <fieldset class="m-0 rounded" style="height: 240px">
                <legend class="w-auto py-1 rounded">الموقع</legend>
                <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d2615432.484748006!2d48.312370218306555!3d25.13265020587655!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2ssa!4v1739697882735!5m2!1sen!2ssa"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </fieldset>
        </div>

        <div class="col-md-12 mx-0 p-1 mb-3">
            <fieldset class="border m-0 rounded">
                <legend class="w-auto py-1 rounded">المشاريع &nbsp;
                    <a href="{{ route('admin-projects-create', [$client->id]) }}"><i class="fa fa-plus text-primary"></i></a>
                    <a href="{{ route('admin-clients-projects-index', [$client->id]) }}"><i class="fa fa-list text-primary"></i></a>
                </legend>
                <div class="row mx-3">

                    @foreach ($client->projects as $project)
                    <div class="col col-md-4 px-1 mb-2">
                        <div class="row border m-0 rounded bg-light shadow-sm" style="overflow: hidden">
                            <div class="col-3 p-1 text-center status-{{ $project->status }}">
                                <h1 class="fw-bold fs-1">{{ $loop->iteration }}</h1>
                                <p class="fw-bold fs-6">{{ strtoupper(substr($project->status, 0, 4)) }}</p>
                            </div>
                            <div class="col-9 p-1">
                                <a href="{{route('admin-projects-show', $project->id)}}">
                                    <b>{{ $project->s_number }}</b><br>
                                </a>
                                <b>تاريخ البدء: {{ $project->start_date }}</b><br>
                                <b>تاريخ الانتهاء: {{ $project->end_date }}</b><br>
                                <b>الحالة: {{ $project->status }}</b>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </fieldset>
        </div>

        <div class="col-md-12 mx-0 p-1 mb-3">
            <fieldset class="border m-0 rounded">
                <legend class="w-auto py-1 rounded">الفواتير &nbsp;
                    <a href="{{ route('admin-invoices-create', $client->id) }}"> <i class="fa fa-plus text-primary"></i></a>  
                </legend>
                @foreach ($client->invoices as $invoice)
                <div class="border rounded">
                    <h5>فاتورة رقم {{ @$invoice->id }}</h5>
                    <small>تاريخ الإصدار: {{ @$invoice->issue_date }}</small><br>
                    <small>المبلغ: {{ @$invoice->amount }}</small><br>
                    <small>الحالة: {{ @$invoice->status }}</small>
                </div>
                @endforeach
                
            </fieldset>
        </div>

        <div class="col-md-12 mx-0 p-1 mb-3">
            <fieldset class="border m-0 rounded">
                <legend class="w-auto py-1 rounded">المدفوعات &nbsp;
                    <a href="{{ route('admin-payments-create', $client->id) }}"> <i class="fa fa-plus text-primary"></i></a>  
                </legend>
                @foreach ($client->payments as $payment)
                <div class="border p-2 mb-2">
                    <small>تاريخ الدفع: {{ @$payment->payment_date }}</small><br>
                    <small>المبلغ: {{ @$payment->amount }}</small><br>
                    <small>الطريقة: {{ @$payment->method }}</small>
                </div>
                @endforeach
                <h5>إجمالي المدفوعات: {{ @$client->total_payments }}</h5>
            </fieldset>
        </div>

        <div class="col-md-12 mx-0 p-1 mb-3">
            <fieldset class="border m-0 rounded">
                <legend class="w-auto py-1 rounded">الملاحظات &nbsp;
                    <a href="{{ route('admin-notes-create', $client->id) }}" class="fa fa-plus text-primary"></a>
                </legend>
                @forelse ( [] as $note)
                <div class="border p-2 mb-2">
                    <small>التاريخ: {{ @$note->note_date }}</small><br>
                    <p>{{ @$note->content }}</p>
                </div>
                @empty
                <div class="border p-2 mb-2">
                    
                    <p>No notes found</p>
                </div>
                @endforelse
            </fieldset>
        </div>
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
