@extends('admin.layouts.app')

@section('header-breadcrumb')
<div class="breadcrumb-item"><a href="{{ route('admin-users-index') }}">{{ __('users.users_list') }}</a></div>
<div class="breadcrumb-item active">{{ __('users.settings') }}</div>
@endsection
@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
@endsection
@section('content')
<div class="container">
    <fieldset class="rounded mt-4">
        <legend class="rounded py-1">
            {{ __('users.settings') }}
        </legend>

        <div class="row">
            <!-- المسميات الوظيفية -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header py-2 px-3 bg-light">
                        <h5>{{ __('users.job_titles') }}
                            <a class="btext-primary" data-bs-toggle="modal" data-bs-target="#addJobTitleModal">
                                <i title="{{ __('users.add_job_title') }}" class="fas fa-plus"></i>
                            </a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="myTable ">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" width="5%">#</th>
                                        <th>{{ __('users.title') }}</th>
                                        <th>{{ __('users.description') }}</th>
                                        <th class="text-center" width="10%">{{ __('users.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($jobTitles as $index => $title)
                                    <tr id="job-title-row-{{ $title->id }}">
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            <span class="title-text">{{ $title->name }}</span>
                                        </td>
                                        <td>
                                            <span class="description-text">{{ $title->description }}</span>
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" class="text-primary edit-job-title me-2" 
                                               data-bs-toggle="modal" 
                                               data-bs-target="#editJobTitleModal"
                                               data-id="{{ $title->id }}"
                                               data-name_ar="{{ $title->name_ar }}"
                                               data-name_en="{{ $title->name_en}}"
                                               data-description_ar="{{ $title->description_ar }}"
                                               data-description_en="{{ $title->description_en }}"
                                               data-status="{{ $title->status }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin-users-delete-job-title', $title->id) }}" 
                                                  method="POST" 
                                                  class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-link text-danger p-0"
                                                        onclick="return confirm('{{ __('general.confirm_delete') }}')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">{{ __('users.no_job_titles') }}</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            
                            <!-- نموذج إضافة مسمى وظيفي جديد -->
                            <form id="add-job-title-form" action="{{ route('admin-users-create-job-title') }}" method="POST">
                                @csrf
                                <h4 class="my-3 border-2 border-bottom py-2">{{ __('users.add_new_job_title') }}</h4>
                                <div class="input-group mb-2">
                                    <label for="name_ar" class="input-group-text">{{ __('users.job_title_name_ar') }}</label>
                                    <input type="text" name="name_ar" class="form-control form-control-sm" 
                                           placeholder="{{ __('users.name_ar_placeholder') }}">
                                    <label for="name_en" class="input-group-text">{{ __('users.job_title_name_en') }}</label>
                                    <input type="text" name="name_en" class="form-control form-control-sm" 
                                           placeholder="{{ __('users.name_en_placeholder') }}">
                                </div>
                                <div class="input-group mb-2">
                                    <label for="description_ar" class="input-group-text">{{ __('users.job_title_description_ar') }}</label>
                                    <input type="text" name="description_ar" class="form-control form-control-sm" 
                                           placeholder="{{ __('users.description_ar_placeholder') }}">
                                    </div>
                                <div class="input-group mb-2">
                                    <label for="description_en" class="input-group-text">{{ __('users.job_title_description_en') }}</label>
                                    <input type="text" name="description_en" class="form-control form-control-sm" 
                                           placeholder="{{ __('users.description_en_placeholder') }}">
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn w-100 py-1 btn-outline-success">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </fieldset>
</div>

<!-- Modal تعديل مسمى وظيفي -->
<div class="modal fade" id="editJobTitleModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 800px;">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('users.edit_job_title') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editJobTitleForm" class="px-4 py-3" action="{{ route('admin-users-update-job-title') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="">
                <div class="input-group mb-2">
                    <label for="name_ar" class="input-group-text">{{ __('users.job_title_name_ar') }}</label>
                    <input type="text" name="name_ar" id="name_ar" class="form-control form-control-sm" 
                           placeholder="{{ __('users.name_ar_placeholder') }}">
                    <label for="name_en" class="input-group-text">{{ __('users.job_title_name_en') }}</label>
                    <input type="text" name="name_en" id="name_en" class="form-control form-control-sm" 
                           placeholder="{{ __('users.name_en_placeholder') }}">
                </div>
                <div class="input-group mb-2">
                    <label for="description_ar" class="input-group-text">{{ __('users.job_title_description_ar') }}</label>
                    <input type="text" name="description_ar" id="description_ar" class="form-control form-control-sm" 
                           placeholder="{{ __('users.description_ar_placeholder') }}">
                    </div>
                <div class="input-group mb-2">
                    <label for="description_en" class="input-group-text">{{ __('users.job_title_description_en') }}</label>
                    <input type="text" name="description_en" id="description_en" class="form-control form-control-sm" 
                           placeholder="{{ __('users.description_en_placeholder') }}">
                </div>

                <input type="hidden" name="status" value="" id="status">
                <div class="btn-group d-flex justify-content-center">
                    <button type="submit" class="btn py-1 btn-outline-success" style="flex: 1;">
                        <i class="fas fa-check"></i> {{ __('users.save') }}
                    </button>
                    <button type="button" class="btn py-1 btn-outline-success" 
                        data-bs-dismiss="modal" style="flex: 1;">
                        <i class="fas fa-check"></i> {{ __('users.close') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js">

</script>
<script>
    let table = new DataTable('#myTable');
    document.addEventListener('DOMContentLoaded', function() {
        // إضافة مسمى وظيفي جديد
        const addNewButton = document.querySelector('.add-new-job-title');
        if (addNewButton) {
            addNewButton.addEventListener('click', function() {
                const titleInput = document.querySelector('input[name="new_title"]');
                const descriptionInput = document.querySelector('input[name="new_description"]');
                
                if (!titleInput.value.trim()) {
                    alert('{{ __("users.title_required") }}');
                    return;
                }

                // إرسال البيانات
                fetch('{{ route("admin-users-add-job-title") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        title: titleInput.value,
                        description: descriptionInput.value
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    } else {
                        alert(data.message || '{{ __("users.error_adding_job_title") }}');
                    }
                });
            });
        }
        // تعديل المسمى الوظيفي
    });
</script>
@endsection
@section('footer_scripts')
<script>
$(document).ready(function() {
       
    $('.edit-job-title').on('click', function(e) {
        e.preventDefault();

        $('#editJobTitleModal #name_ar').val($(this).data('name_ar'));
        $('#editJobTitleModal #name_en').val($(this).data('name_en'));
        $('#editJobTitleModal #description_ar').val($(this).data('description_ar'));
        $('#editJobTitleModal #description_en').val($(this).data('description_en'));
        $('#editJobTitleModal #status').val($(this).data('status'));
        $('#editJobTitleModal #jobTitleId').val($(this).data('id'));
        
        $('#editJobTitleModal').show();

        console.log([
            $(this).data('id'), 
            $(this).data('name_ar'), 
            $(this).data('name_en'), 
            $(this).data('description_ar'), 
            $(this).data('description_en'), 
            $(this).data('status')
        ]);
    });
});
</script>
@endsection