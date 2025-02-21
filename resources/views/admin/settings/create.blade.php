@extends('admin.layouts.app')

@section('header-breadcrumb')
<div class="breadcrumb-item"><a href="{{ route('admin-settings-index') }}">{{ __('settings.settings_list_title') }}</a></div>
<div class="breadcrumb-item active">{{ __('settings.create_new') }}</div>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('settings.create_new') }}</h4>
                </div>

                <form action="{{ route('admin-settings-store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <!-- المجموعة -->
                        <div class="form-group">
                            <label>{{ __('settings.group') }}</label>
                            <input type="text" name="group" class="form-control @error('group') is-invalid @enderror" 
                                   value="{{ old('group') }}" required>
                            @error('group')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- المفتاح -->
                        <div class="form-group">
                            <label>{{ __('settings.key') }}</label>
                            <input type="text" name="key" class="form-control @error('key') is-invalid @enderror" 
                                   value="{{ old('key') }}" required>
                            @error('key')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- النوع -->
                        <div class="form-group">
                            <label>{{ __('settings.type') }}</label>
                            <select name="type" class="form-control @error('type') is-invalid @enderror" required>
                                <option value="string" {{ old('type') == 'string' ? 'selected' : '' }}>{{ __('settings.types.string') }}</option>
                                <option value="boolean" {{ old('type') == 'boolean' ? 'selected' : '' }}>{{ __('settings.types.boolean') }}</option>
                                <option value="integer" {{ old('type') == 'integer' ? 'selected' : '' }}>{{ __('settings.types.integer') }}</option>
                                <option value="float" {{ old('type') == 'float' ? 'selected' : '' }}>{{ __('settings.types.float') }}</option>
                                <option value="array" {{ old('type') == 'array' ? 'selected' : '' }}>{{ __('settings.types.array') }}</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- النطاق -->
                        <div class="form-group">
                            <label>{{ __('settings.scope') }}</label>
                            <select name="scope" class="form-control @error('scope') is-invalid @enderror" required>
                                <option value="global" {{ old('scope') == 'global' ? 'selected' : '' }}>{{ __('settings.scopes.global') }}</option>
                                <option value="user" {{ old('scope') == 'user' ? 'selected' : '' }}>{{ __('settings.scopes.user') }}</option>
                                <option value="role" {{ old('scope') == 'role' ? 'selected' : '' }}>{{ __('settings.scopes.role') }}</option>
                            </select>
                            @error('scope')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- القيمة -->
                        <div class="form-group">
                            <label>{{ __('settings.value') }}</label>
                            <textarea name="value" class="form-control @error('value') is-invalid @enderror" 
                                      rows="3" required>{{ old('value') }}</textarea>
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
                                      rows="2">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- الخيارات -->
                        <div class="form-group">
                            <label>{{ __('settings.options') }}</label>
                            <textarea name="options" class="form-control @error('options') is-invalid @enderror" 
                                      rows="3">{{ old('options') }}</textarea>
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
                                       id="is_public" {{ old('is_public') ? 'checked' : '' }}>
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
