@extends('admin.layouts.app')

@section('header-breadcrumb')
<div class="breadcrumb-item active">{{ __('settings.settings_list_title') }}</div>
@endsection

@section('content')
<div class="container">
    <fieldset class="rounded mt-4">
        
        <legend class="rounded">
            {{ __('settings.settings_list_title') }}
            <a href="{{ route('admin-settings-create') }}" class="btn py-0 text-primary">
                <i class="fas fa-plus"></i> {{ __('settings.create_new') }}
            </a>
        </legend>

              
        <h6> <i class="fa fa-filter"></i>{{ __('settings.filter_by_group') }}</h6>
        <div class="btn-group">
            @php
                $groups = \App\Models\Setting::select('group')->distinct()->pluck('group');
            @endphp
            @foreach($groups as $groupName)
                <a href="{{ route('admin-settings-group', $groupName) }}" 
                    class="btn btn-sm btn-outline-primary {{ request()->segment(4) == $groupName ? 'active' : '' }}">
                    {{ __("settings.groups.$groupName") }}
                </a>
            @endforeach
        </div>
                    
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ __('settings.group') }}</th>
                        <th>{{ __('settings.key') }}</th>
                        <th>{{ __('settings.value') }}</th>
                        <th>{{ __('settings.type') }}</th>
                        <th>{{ __('settings.scope') }}</th>
                        <th>{{ __('settings.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($settings as $setting)
                        <tr>
                            <td>{{ __("settings.groups.{$setting->group}") }}</td>
                            <td>{{ $setting->key }}</td>
                            <td>
                                @if($setting->type == 'boolean')
                                    <button class="btn btn-sm {{ $setting->value == '1' ? 'btn-success' : 'btn-danger' }}">
                                        {{ $setting->value  ? __('general.yes') : __('general.no')}}
                                    </button>
                                @elseif($setting->type == 'array')
                                <div class="input-group">
                                    <select class="form-control">
                                        @foreach ($setting->value as $item)
                                            <option>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @else
                                    {{ $setting->value }}
                                @endif
                            </td>
                            <td>{{ $setting->type }}</td>
                            <td>
                                <span class="badge badge-primary">{{ $setting->scope }}</span>
                                @if($setting->scope_id)
                                    ({{ $setting->scope_id }})
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin-settings-edit', $setting->id) }}" 
                                    class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <form action="{{ route('admin-settings-destroy', $setting->id) }}" 
                                        method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('{{ __('general.confirm_delete') }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- الترقيم -->
        <div class="mt-4">
            {{ $settings->links() }}
        </div>
                
    </fieldset>
</div>

<!-- نوافذ عرض المصفوفات -->
@foreach($settings as $setting)
    @if($setting->type == 'array')
        <div class="modal fade" id="arrayModal{{ $setting->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $setting->key }}</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       @if (is_array($setting->value))
                       @foreach ($setting->value as $key => $value)
                       <pre>{{ $key }}: {{ $value }}</pre>
                       @endforeach
                       @else
                       <pre>{{ $setting->value }}</pre>
                       @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach
@endsection
