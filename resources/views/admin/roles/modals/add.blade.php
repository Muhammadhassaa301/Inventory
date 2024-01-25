<div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-add-new-role">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-5 pb-5">
                <div class="text-center mb-4">
                    <h1 class="role-title">Add New Role</h1>
                    <p>Set role permissions</p>
                </div>
                <!-- Add role form -->
                <form id="addRoleForm" class="row" method="POST" action="{{ route('admin.role.create') }}">
                    @csrf
                    <div class="col-12">
                        <label class="form-label" for="modalRoleName">Role Name</label>
                        <input type="text" id="modalRoleName" name="name" class="form-control"
                               placeholder="Enter role name" tabindex="-1" data-msg="Please enter role name"/>
                    </div>
                    <div class="col-12">
                        <h4 class="mt-2 pt-50">Role Permissions</h4>
                        <!-- Permission table -->
                        <div class="table-responsive">
                            <table class="table table-flush-spacing">
                                <tbody>
                                <tr>
                                    <td class="text-nowrap fw-bolder">
                                        Administrator Access
                                        <span data-bs-toggle="tooltip" data-bs-placement="top"
                                              title="Allows a full access to the system">
                                                                <i data-feather="info"></i>
                                                            </span>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="selectAll"/>
                                            <label class="form-check-label" for="selectAll"> Select All </label>
                                        </div>
                                    </td>
                                </tr>
                                @foreach($modules as $module)
                                    @php $permissions = $module->permissions @endphp
                                    <tr>
                                        <td class="text-nowrap fw-bolder pt-3 pb-3">{{ $module->name }}</td>
                                        <td>
                                            <div class="d-flex">
                                                @foreach($permissions as $permission)
                                                    <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox"
                                                               name="permission[]"
                                                               value="{{ $permission->name }}"
                                                               id="add-permission-{{ $permission->id }}"/>
                                                        <label class="form-check-label"
                                                               for="add-permission-{{ $permission->id }}">{{ ucwords(str_replace(['.','_','-'],' ',$permission->name)) }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Permission table -->
                    </div>

                    <div class="col-12 text-center mt-2">
                        <button type="submit" class="btn btn-primary me-1">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
                <!--/ Add role form -->
            </div>
        </div>
    </div>
</div>
