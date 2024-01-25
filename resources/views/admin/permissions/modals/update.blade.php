<div class="modal fade" id="editPermissionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3 pt-0">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Edit Permission</h1>
                    <p>Edit permission as per your requirements.</p>
                </div>

                <form id="editPermissionForm" class="row" method="post" action="{{ route('admin.permission.update') }}">
                    @csrf
                    <input type="hidden" name="permission_id" class="permission_id" value="">
                    <div class="col-12">
                        <label class="form-label" for="moduleedit">Module

                            <a href="javascript:void(0)" class="badge badge-light-primary ms-1 add_module_modal"
                               data-bs-toggle="modal" data-bs-target="#addmodulemodal" data-active-modal="#editPermissionModal"
                               title="Add Module"><span><i data-feather='plus'></i></span></a>

                        </label>
                        <select id="moduleedit" name="module_id" class="form-control module">
                            <option value="" >Select Module</option>
                            @foreach($modules as $module)
                                <option value="{{ $module->id }}" >{{ $module->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <label class="form-label" for="editPermissionName">Permission Name</label>
                        <input type="text" id="editPermissionName" name="name" value="" class="form-control perm_name" placeholder="Enter a permission name" tabindex="-1" data-msg="Please enter permission name" />
                    </div>
                    <div class="col-sm-12 ps-sm-0">
                        <button type="submit" class="btn btn-primary mt-2">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
