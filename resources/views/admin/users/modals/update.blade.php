<div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Edit User Information</h1>
                    <p>Updating user details will receive a privacy audit.</p>
                </div>
                <form id="editUserForm" class="row gy-1 pt-75" method="post" action="{{ route('admin.user.update') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    {{--                    <div class="col-12 col-md-6">--}}
                    {{--                        <label class="form-label" for="modalEditUserFirstName">First Name</label>--}}
                    {{--                        <input type="text" id="modalEditUserFirstName" name="modalEditUserFirstName" class="form-control" placeholder="John" value="Gertrude" data-msg="Please enter your first name" />--}}
                    {{--                    </div>--}}
                    {{--                    <div class="col-12 col-md-6">--}}
                    {{--                        <label class="form-label" for="modalEditUserLastName">Last Name</label>--}}
                    {{--                        <input type="text" id="modalEditUserLastName" name="modalEditUserLastName" class="form-control" placeholder="Doe" value="Barton" data-msg="Please enter your last name" />--}}
                    {{--                    </div>--}}
                    <div class="col-12">
                        <label class="form-label" for="modalEditUserName">Full Name</label>
                        <input type="text" id="modalEditUserName" name="name" class="form-control"
                               value="{{ $user->name }}" placeholder="Full Name"/>
                    </div>
                    <div class="col-12 col-md-12">
                        <label class="form-label" for="modalEditUserEmail">Email:</label>
                        <input type="text" id="modalEditUserEmail" name="email" class="form-control"
                               value="{{ $user->email }}" placeholder="example@domain.com"/>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalEditTaxID">Password</label>
                        <input type="text" id="modalEditTaxID" name="password" class="form-control modal-edit-tax-id"
                               placeholder="**********"/>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="user-department">Department</label>
                        <select class="form-select" id="user-department" name="department">
                            <option value="">Select Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ $user->department_id ? 'selected' : '' }} data-id="{{ $department->id }}">{{ $department->title }}</option>
                            @endforeach
                        </select>
                    </div>
{{--                    <div class="col-12 col-md-6">--}}
{{--                        <label class="form-label" for="modalEditUserStatus">Status</label>--}}
{{--                        <select id="modalEditUserStatus" name="status" class="form-select"--}}
{{--                                aria-label="Default select example">--}}
{{--                            <option selected>Status</option>--}}
{{--                            <option value="active" @if($user->status == 'active') selected @endif>Active</option>--}}
{{--                            <option value="in_active" @if($user->status == 'in_active') selected @endif>Inactive--}}
{{--                            </option>--}}
{{--                            <option value="suspended" @if($user->status == 'suspended') selected @endif>Suspended--}}
{{--                            </option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="col-12 col-md-6">--}}
{{--                        <label class="form-label" for="modalEditUserPhone">Contact</label>--}}
{{--                        <input type="text" id="modalEditUserPhone" name="phone" class="form-control phone-number-mask"--}}
{{--                               placeholder="+1 (609) 933-44-22" value="{{ $user->phone }}"/>--}}
{{--                    </div>--}}



                    {{--                    <div class="col-12 col-md-6">--}}
                    {{--                        <label class="form-label" for="user-shift">User Shift</label>--}}
                    {{--                        <select id="user-shift" class=" form-select" name="shift">--}}
                    {{--                            <option value="">Select Shift</option>--}}
                    {{--                            @foreach($shifts as $shift)--}}
                    {{--                                <option @if($shift->id==$user->current_shift?->id) selected @endif--}}
                    {{--                                value="{{ $shift->id }}">{{ \Illuminate\Support\Carbon::createFromDate($shift->timein)->format('h:i A') }}--}}
                    {{--                                    - {{ \Illuminate\Support\Carbon::createFromDate($shift->timeout)->format('h:i A') }}</option>--}}
                    {{--                            @endforeach--}}
                    {{--                        </select>--}}
                    {{--                    </div>--}}

                    {{--                    <div class="mb-1">--}}
                    {{--                        <label class="form-label" for="basic-icon-default-contact">Effective Date Of Shift</label>--}}
                    {{--                        <input type="date" id="basic-icon-default-contact" class="form-control"--}}
                    {{--                               name="effective_date" value="{{ $user->current_shift?->pivot->effective_date }}"/>--}}
                    {{--                    </div>--}}


                    <div class="col-12 col-md-6">
                        <label class="form-label" for="user-role">User Role</label>
                        <select id="user-role" class=" form-select" name="role[]" multiple>
                            <option value="">Select Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}"
                                        @if(in_array($role->name,$user->getRoleNames()->toArray())) selected @endif>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-1">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="is_disabled"
                                   @if($user->is_disabled) checked @endif id="disable_login" value="1">
                            <label class="form-check-label" for="disable_login">Disable Login</label>
                        </div>
                    </div>
                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit" class="btn btn-primary me-1">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
