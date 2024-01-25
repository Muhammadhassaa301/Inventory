<div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-add-department">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-add-department"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Add Department</h1>
                </div>
{{--                <form id="add-department-form" class="row gy-1 pt-75" action="{{ route('admin.department.store') }}" method="POST">--}}
{{--                    @csrf--}}
                <form id="add-department-form" class="row gy-1 pt-75" action="">
                <div class="col-12">
                        <label class="form-label" for="modalAddTitle">Title</label>
                        <input type="text" id="modalAddTitle" name="title" class="form-control"
                               placeholder="Title" autocomplete="off" required/>
                        <div class="text-danger d-none"></div>
                    </div>

                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit" class="btn btn-primary me-1" id="create_department">Create Department</button>
                        <button type="reset" class="btn btn-outline-secondary add-department-close-btn" data-bs-dismiss="modal"
                                aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

