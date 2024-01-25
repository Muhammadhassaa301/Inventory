<div class="text-center mb-2">
    <h1 class="mb-1">Edit Department</h1>
</div>
{{--<form id="edit-department-form" class="row gy-1 pt-75" action="{{ route('admin.department.update', $department->id) }}}" method="POST">--}}
{{--    @csrf--}}
    <form id="edit-department-form" class="row gy-1 pt-75" action="">
        <input type="hidden" class="department_id" value="{{ $department->id }}">
        <div class="col-12">
        <label class="form-label" for="modalEditDepartmentTitle">Title</label>
        <input type="text" id="modalEditDepartmentTitle" name="title" class="form-control"
               value="{{ $department->title }}" placeholder="Title" autocomplete="off" required/>
        <div class="text-danger d-none"></div>
    </div>

    <div class="col-12 text-center mt-2 pt-50">
        <button type="submit" class="btn btn-primary me-1" id="update_department">Update Department</button>
        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                aria-label="Close">
            Discard
        </button>
    </div>
</form>
