@extends('admin.layouts.app')
@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
@endsection
@section('footer_scripts')
    @parent
@endsection
@section('content')
<div class="container">
    <fieldset class="">
        <legend class="">{{__('client_projects_list')}} &nbsp; 
            <a href="{{ route('admin-projects-create', ['client'=>$client->id]) }}"><i class="fa fa-plus text-primary"></i></a>
        </legend>
        <div class="p-3">
            <table id="myTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('projects.project_name')}}</th>
                        <th>{{__('projects.s_number')}}</th>
                        <th>{{__('projects.city')}}</th>
                        <th>{{__('projects.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($client->projects as $project)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->s_number }}</td>
                            <td>{{ $project->city }}</td>
                            <td>
                                <a href="{{route('admin-projects-show', $project->id)}}" class="btn btn-sm py-0 btn-outline-success">{{__('projects.show')}}</a>
                                <a href="{{route('admin-projects-edit', $project->id)}}" class="btn btn-sm py-0 btn-outline-primary">{{__('projects.edit')}}</a>
                                <form action="{{route('admin-projects-destroy', $project->id)}}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm py-0 btn-outline-danger">{{__('projects.delete')}}</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        
                    @endforelse
                </tbody>
            </table>
        </div>
    </fieldset>
</div>
@endsection