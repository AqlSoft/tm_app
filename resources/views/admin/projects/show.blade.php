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

        <div class="col-md-6 mb-4">
            <fieldset class="">
                <legend class="">{{__('projects.project_details')}}&nbsp;</legend>
                <div class="px-3 mb-3">
                    <h5>{{__('projects.project_name')}}: {{ $project->name }}</h5>
                    <h5>{{__('projects.project_s_number')}}: {{ $project->s_number }}</h5>
                    <small>{{__('projects.project_description')}}: {{ $project->description ?? 'لا يوجد وصف' }}</small><br>
                    <small>{{__('projects.project_start_date')}}: {{ $project->start_date }}</small><br>
                    <small>{{__('projects.project_end_date')}}: {{ $project->end_date }}</small><br>
                    <small>{{__('projects.project_status')}}: {{ $project->status }}</small>
                </div>
            </fieldset>
        </div>

        <div class="col-md-6 mb-4">
            <fieldset class="">
                <legend class=""> {{__('projects.client')}} </legend>
                <div class="px-3 mb-3">
                    <h5>{{__('projects.client_name')}}: {{ $project->client->name }}</h5>
                    <h5>{{__('projects.client_s_number')}}: {{ $project->client->s_number }}</h5>
                    <small>{{__('projects.client_phone')}}: {{ $project->client->phone }}</small><br>
                    <small>{{__('projects.client_email')}}: {{ $project->client->email }}</small><br>
                    <small>{{__('projects.client_city')}}: {{ $project->client->city }}</small><br>
                    <small>{{__('projects.client_address')}}: {{ $project->client->address }}</small>
                </div>
            </fieldset>
        </div>

        <div class="col-md-12 mb-4">
            <fieldset class="">
                <legend class=""> {{__('projects.operations')}} &nbsp; 
                    <a data-bs-toggle="modal" data-bs-target="#addOperationModal" href="{{ route('admin-operations-create', [$project->id]) }}"> <i class="fa fa-plus text-primary"></i></a>
                </legend>
                <div class="row mx-3 mb-3">
                    @forelse ($project->operations as $operation)
                    <div class="col col-md-4">
                        <div class="card">
                            <div class="card-header py-1 px-3">
                                {{ $operation->order }} - {{ $operation->name }} &nbsp; 
                                <a href="{{ route('admin-operations-edit', [$project->id, $operation->id]) }}"> <i class="fa fa-edit text-primary"></i></a>
                            </div>
                            <div class="card-body px-0 py-2">
                                <p class="m-0 px-2 py-0">{{ $operation->description }}</p>
                                <p class="m-0 px-2 py-0">Supervisor: {{ $operation->supervisor->name }}</p>
                            </div>
                            <div class="card-footer">
                                {{ $operation->status }}
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="col col-12">
                            No Operations has been assigned yet
                        </div>
                    @endforelse
                </div>
            </fieldset>
        </div>

        <div class="col-md-12 mb-4">
            <fieldset class="">
                <legend class=""> التوريدات &nbsp; 
                    <a href="{{ route('admin-tasks-create', $project->id) }}"> <i class="fa fa-plus text-primary"></i></a>
                </legend>
                <div class="px-3 mb-3">
                    <h5>اسم العميل: {{ $project->client->name }}</h5>
                    <h5>الرقم المسلسل: {{ $project->client->s_number }}</h5>
                    <small>رقم الهاتف: {{ $project->client->phone }}</small><br>
                    <small>البريد الالكتروني: {{ $project->client->email }}</small><br>
                    <small>المدينة: {{ $project->client->city }}</small><br>
                    <small>العنوان: {{ $project->client->address }}</small>
                </div>
            </fieldset>
        </div>

        <div class="col-md-12 mb-4">
            <fieldset class="">
                <legend class=""> المدفوعات &nbsp; 
                    <a href="{{ route('admin-tasks-create', $project->id) }}"> <i class="fa fa-plus text-primary"></i></a>
                </legend>
                <div class="px-3 mb-3">
                    <h5>اسم العميل: {{ $project->client->name }}</h5>
                    <h5>الرقم المسلسل: {{ $project->client->s_number }}</h5>
                    <small>رقم الهاتف: {{ $project->client->phone }}</small><br>
                    <small>البريد الالكتروني: {{ $project->client->email }}</small><br>
                    <small>المدينة: {{ $project->client->city }}</small><br>
                    <small>العنوان: {{ $project->client->address }}</small>
                </div>
            </fieldset>
        </div>

        <div class="col-md-12 mb-4">
            <fieldset class="">
                <legend class=""> الفواتير &nbsp; 
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
    <div id="modals">
        <!-- Add Operation Modal -->
        <div class="modal fade" id="addOperationModal" tabindex="-1" aria-labelledby="addOperationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" >
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addOperationModalLabel">{{__('projects.add_operation')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Operation Form -->
                        <form class="mt-4" action="{{ route('admin-operations-store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                            <div class="input-group mb-2">
                                <label class="input-group-text" for="name">{{__('projects.operation_name')}}</label>
                                <input type="text" name="name" class="form-control" required>
                                <label class="input-group-text">{{__('projects.order')}}</label>
                                <input type="hidden" name="order" value="{{App\Models\Operation::count()+1}}">
                                <label class="input-group-text">{{App\Models\Operation::count()+1}}</label>
                            </div>
                            <div class="input-group mb-2">
                                <label class="input-group-text" >{{__('projects.serial_number')}}</label>
                                <input type="hidden" name="s_number" value="{{App\Models\Operation::generateSerialNumber($project)}}">
                                <input type="button" class="form-control" value="{{App\Models\Operation::generateSerialNumber($project)}}">
                            </div>
                            <div class="input-group mb-2">
                                <label class="input-group-text" style="height: auto !important" for="description">{{__('projects.description')}}</label>
                                <textarea name="description" aria-label="Description" rows="3" class="form-control" placeholder="{{__('projects.operation_description')}}"></textarea>
                            </div>
                            <div class="input-group mb-2">
                                <label class="input-group-text" for="starts_at">{{__('projects.starts_at')}}</label>
                                <input type="date" id="starts_at" name="starts_at" class="form-control" >
                            
                                <label class="input-group-text" for="ends_at">{{__('projects.deadline')}}</label>
                                <input type="date" id="deadline" name="deadline" class="form-control">
                            </div>
                            <div class="input-group mb-2">
                                <label class="input-group-text" for="supervisor">{{__('projects.supervisor')}}</label>
                                <select name="supervisor_id" id="supervisor" class="form-control">
                                    <option value="">{{__('projects.select_supervisor')}}</option>
                                    @foreach ($supervisors as $supervisor)
                                        <option value="{{ $supervisor->id }}">{{ $supervisor->name }} - {{$supervisor->profile->job_title}}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="form-control btn btn-outline-primary" style="height: 36px">
                                    <i class="fa fa-save"></i> {{__('projects.save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


