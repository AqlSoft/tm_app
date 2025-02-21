@extends('admin.layouts.app')

@section('header-breadcrumb')
<div class="breadcrumb-item"><a href="{{ route('admin-settings-index') }}">{{ __('settings.settings_list_title') }}</a></div>
<div class="breadcrumb-item active">{{ __('settings.edit_setting') }}</div>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('settings.edit_setting') }}</h4>
                </div>

                <form action="{{ route('admin-settings-update', $setting->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <!-- معلومات ثابتة -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ __('settings.group') }}</label>
                                    <p class="form-control-static">{{ $setting->group }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ __('settings.key') }}</label>
                                    <p class="form-control-static">{{ $setting->key }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ __('settings.type') }}</label>
                                    <p class="form-control-static">{{ $setting->type }}</p>
                                </div>
                            </div>
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
            </div>
        </div>
    </div>
</div>
@endsection
