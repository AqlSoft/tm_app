@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ $team->name }}</h5>
            <div>
                <span class="badge {{ $team->is_active ? 'bg-success' : 'bg-danger' }}">
                    {{ $team->is_active ? 'نشط' : 'معطل' }}
                </span>
                <a href="{{ route('admin-teams-edit', $team) }}" class="btn btn-light btn-sm ms-2">
                    <i class="fa fa-edit"></i> تعديل
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <!-- معلومات الفريق الأساسية -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h6 class="text-muted">معلومات الفريق</h6>
                    <dl class="row">
                        <dt class="col-sm-4">الكود</dt>
                        <dd class="col-sm-8">{{ $team->code }}</dd>
                        
                        <dt class="col-sm-4">قائد الفريق</dt>
                        <dd class="col-sm-8">{{ $leader->name }}</dd>
                        
                        <dt class="col-sm-4">الوصف</dt>
                        <dd class="col-sm-8">{{ $team->brief }}</dd>
                    </dl>
                </div>
                
                <div class="col-md-6">
                    <h6 class="text-muted">إحصائيات</h6>
                    <dl class="row">
                        <dt class="col-sm-4">عدد الأعضاء</dt>
                        <dd class="col-sm-8">{{ $team->members->count() }}</dd>
                        
                        <dt class="col-sm-4">عدد المشاريع</dt>
                        <dd class="col-sm-8">{{ $team->projects->count() }}</dd>
                    </dl>
                </div>
            </div>

            <!-- قائمة أعضاء الفريق -->
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-muted mb-0">أعضاء الفريق</h6>
                    <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addMemberModal">
                        <i class="fa fa-plus"></i> إضافة عضو
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>الدور</th>
                                <th>تاريخ الانضمام</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($team->members as $member)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $member->user->name }}</td>
                                <td>{{ $member->role->name }}</td>
                                <td>{{ $member->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm" onclick="removeMember({{ $member->id }})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- قائمة المشاريع -->
            <div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-muted mb-0">المشاريع المسندة</h6>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>اسم المشروع</th>
                                <th>الحالة</th>
                                <th>تاريخ البدء</th>
                                <th>تاريخ الانتهاء</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($team->projects as $project)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $project->name }}</td>
                                <td>
                                    <span class="badge bg-{{ $project->status_color }}">
                                        {{ $project->status_text }}
                                    </span>
                                </td>
                                <td>{{ $project->start_date }}</td>
                                <td>{{ $project->end_date }}</td>
                                <td>
                                    <a href="{{ route('admin-projects-show', $project) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal إضافة عضو جديد -->
<div class="modal fade" id="addMemberModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة عضو جديد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin-teams-add-member', $team) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">العضو</label>
                        <select name="user_id" class="form-select" required>
                            <option value="">اختر عضواً</option>
                            @foreach($available_members as $member)
                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">الدور</label>
                        <select name="role_id" class="form-select" required>
                            <option value="">اختر دوراً</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">إضافة</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function removeMember(memberId) {
    if (confirm('هل أنت متأكد من حذف هذا العضو من الفريق؟')) {
        fetch(`/admin/teams/members/${memberId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                location.reload();
            } else {
                alert(data.message);
            }
        });
    }
}
</script>
@endpush
@endsection
