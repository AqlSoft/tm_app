@extends('admin.layouts.app')

@section('header-breadcrumb')
<div class="breadcrumb-item"><a href="{{ route('admin-dashboard-settings-index') }}">{{ __('settings.settings_list_title') }}</a></div>
<div class="breadcrumb-item active">{{ __('settings.edit_setting') }}</div>
@endsection

@section('content')
<div class="container">
    <fieldset class="rounded mt-4">
        
        <legend class="py-2 rounded">
            <h4>{{ __('settings.edit_setting') }}</h4>
        </legend>

        <form class="needs-validation mt-3" action="{{ route('admin-dashboard-settings-update', $setting->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <!-- معلومات ثابتة -->
                <div class="input-group">
                    <label class="input-group-text">{{ __('settings.group') }}</label>
                    <button class="form-control">{{ $setting->group }}</button>
                
                
                    <label class="input-group-text">{{ __('settings.key') }}</label>
                    <button class="form-control">{{ $setting->key }}</button>
                
                    <label class="input-group-text">{{ __('settings.type') }}</label>
                    <button class="form-control">{{ $setting->type }}</button>
                </div>
                <!-- القيمة -->
                <div class="form-group">
                    <label>{{ __('settings.value') }}</label>
                    @if($setting->type == 'boolean')
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="value" class="custom-control-input" 
                                    id="value" {{ old('value', $setting->value) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="value">
                                {{ __('settings.enabled') }}
                            </label>
                        </div>
                    @else
                        <textarea name="value" class="form-control @error('value') is-invalid @enderror" 
                                    rows="3" required>{{ old('value', $setting->value) }}</textarea>
                    @endif
                    @error('value')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">
                        {{ __('settings.value_help') }}
                    </small>
                </div>

                <!-- الوصف -->
                <div class="form-group">
                    <label>{{ __('settings.description') }}</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                                rows="2">{{ old('description', $setting->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- الخيارات -->
                <div class="form-group">
                    <label>{{ __('settings.options') }}</label>
                    <textarea name="options" class="form-control @error('options') is-invalid @enderror" 
                                rows="3">{{ old('options', json_encode($setting->options, JSON_PRETTY_PRINT)) }}</textarea>
                    @error('options')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">
                        {{ __('settings.options_help') }}
                    </small>
                </div>

                <!-- عام/خاص -->
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="is_public" class="custom-control-input" 
                                id="is_public" {{ old('is_public', $setting->is_public) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="is_public">
                            {{ __('settings.is_public') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ __('general.save') }}
                </button>
            </div>
        </form>
    </fieldset>
        
</div>
@endsection
