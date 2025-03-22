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

        <div class="col col-12 px-0">
            <fieldset class="">
                <legend class="w-auto py-1 rounded">{{__('clients.client_info')}} &nbsp; 
                    <a href="{{ route('admin-clients-edit', [$client->id]) }}"><i class="fa fa-edit text-primary"></i></a>
                </legend>
                {{-- client logo --}}
                <div class="row">
                    <div class="col col-md-4">
                        <img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->getNameAttribute() }}" class="img-fluid">
                    </div>
                </div>
            </fieldset>
        </div>

        <div class="col-md-12 mx-0 p-1 mb-3">
            <fieldset class="border m-0 rounded">
                <legend class="w-auto py-1 rounded">{{__('clients.projects')}} &nbsp;
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
