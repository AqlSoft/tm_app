@extends ('admin.layouts.app')

@section('content')
<div class="container">
    <fieldset class="">
        <legend class="py-2 rounded">{{__('teams.create_team')}}
            <a href="{{route('admin-teams-index')}}" class="><i class="fa fa-home"></i> {{__('teams.back')}}</a>
        </legend>
        <form action="{{ route('admin-teams-update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="input-group mb-2">
                <label class="input-group-text" for="name">{{__('teams.team_name')}}</label>
                <input type="text" name="name_ar" placeholder="{{__('teams.team_name_ar')}}" class="form-control" value="{{ old('name_ar', $team) }}" required>
                <input type="text" name="name_en" placeholder="{{__('teams.team_name_en')}}" class="form-control" value="{{ old('name_en', $team) }}" required>
            </div>
            <div class="input-group mb-2">
                <label class="input-group-text" for="brief">{{__('teams.team_description')}}</label>
                <input type="text" name="brief" placeholder="{{__('teams.team_description_placeholder')}}" class="form-control" value="{{ old('description', $team) }}">
            </div>

            <div class="input-group mb-2">
                <label for="leader" class="input-group-text">{{__('teams.leader')}}</label>
                <select name="leader_id" class="form-control">
                    <option hidden>{{__('teams.select_leader')}}</option>
                    @foreach ($members as $member)
                        <option value="{{ $member->id }}" {{ old('leader_id', $team) == $member->id ? 'selected' : '' }}>
                            {{ $member->name }}
                        </option>
                    @endforeach
                </select>
                <label for="code" class="input-group-text">{{__('teams.code')}}</label>
                <input type="text" name="code" placeholder="{{__('teams.code_placeholder')}}" class="form-control" value="{{ old('code', $team) ?? $team_code }}">
            </div>

            <div class="input-group mb-2">
                <label class="input-group-text">{{__('teams.status')}}</label>
                <div class="form-control d-flex gap-2">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="is_active" value="1" {{ $team->is_active ? 'checked' : '' }} id="status_active">
                        <label class="form-check-label text-success" for="status_active">نشط</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="is_active" value="0" {{ !$team->is_active ? 'checked' : '' }} id="status_inactive">
                        <label class="form-check-label text-danger" for="status_inactive">معطل</label>
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-end pt-3">
                <button type="submit" 
                    class="btn py-1 btn-outline-primary">
                    <i class="fa fa-save"></i> {{__('teams.create')}}</button>
            </div>
        </form>
    </fieldset>
</div>
@endsection