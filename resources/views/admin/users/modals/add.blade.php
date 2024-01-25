<div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
    <div class="modal-dialog">
        <form method="post" action="{{ route('admin.user.add') }}" class="add-new-user modal-content pt-0">
            @csrf
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
            </div>
            <div class="modal-body flex-grow-1">
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                    <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname"
                           placeholder="John Doe" name="name"/>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-email">Email</label>
                    <input type="text" id="basic-icon-default-email" class="form-control dt-email"
                           placeholder="john.doe@example.com" name="email"/>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-contact">Password</label>
                    <input type="text" id="basic-icon-default-contact" class="form-control" placeholder="**********"
                           name="password"/>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="user-department">Department</label>
                    <select class="form-select" id="user-department" name="department">
                        <option value="">Select Department</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" data-id="{{ $department->id }}">{{ $department->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="user-role">User Role</label>
                    <select id="user-role" class=" form-select" name="role[]" multiple>
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" data-id="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-1">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="is_disabled" id="disable_login" value="1">
                        <label class="form-check-label" for="disable_login">Disable Login</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary me-1 data-submit add_user_btn">Submit</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>
