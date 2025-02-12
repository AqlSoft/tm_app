@extends('admin.layouts.app')

@section('content')
<div class="p-4 sm:ml-64 rtl:sm:mr-64 rtl:sm:ml-0">
    <div class="mt-14"> {{-- Add top margin to prevent overlap with header --}}
        <h1 class="text-2xl font-semibold mb-6">{{ __('dashboard.dashboard') }}</h1>
        
        <div class="mb-6">
            <ul class="btn-group gap-2" role="tablist">
                <li class="flex-none" role="presentation">
                    <a class="btn px-3 btn-outline-primary btn-sm" 
                            id="pills-roles-list-tab" 
                            data-toggle="pill" 
                            data-target="#pills-roles-list" 
                            role="tab">
                        {{__('dashboard.roles_list')}}
                    </a>
                </li>
                <li class="flex-none" role="presentation">
                    <a class="btn px-3 btn-outline-primary btn-sm" 
                            id="pills-add-role-tab" 
                            data-toggle="pill" 
                            data-target="#pills-add-role" 
                            role="tab">
                        {{__('dashboard.add_new_role')}}
                    </a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col col-lg-6">
            <div class="card rounded-lg shadow-md">
                <div class="card-header px-4 py-2">
                    <h3 class="text-lg font-medium">{{__('dashboard.projects_list')}}</h3>
                </div>
                <div class="card-body p-4">
                    <p class="mb-4">{{__('dashboard.projects_count')}}: 10</p>
                    
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a class="btn btn-outline-primary btn-sm" href="{{ route('admin-projects-index') }}">
                        {{__('dashboard.show_projects')}}
                    </a>
                </div>
            </div>
        </div>

        <div class="col col-lg-6">
            <div class="card rounded-lg shadow-md">
                <div class="card-header px-4 py-2">
                    <h3 class="text-lg font-medium">{{__('dashboard.tasks_list')}}</h3>
                </div>
                <div class="card-body p-4">
                    <p class="mb-4">{{__('dashboard.tasks_count')}}: 25</p>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a class="btn btn-outline-primary btn-sm" href="{{ route('admin-tasks-index') }}">
                        {{__('dashboard.show_tasks')}}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection