@extends('admin.layouts.master')
@section('title','Users List')
@section('content')

    <!-- BEGIN: Content-->

    <div class="content-body">
        <!-- users list start -->
        <section class="app-user-list">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="fw-bolder mb-75">{{ $users->count() }}</h3>
                                <span>Total Users</span>
                            </div>
                            <div class="avatar bg-light-primary p-50">
                                        <span class="avatar-content">
                                            <i data-feather="user" class="font-medium-4"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="fw-bolder mb-75">4</h3>
                                <span>Active Users</span>
                            </div>
                            <div class="avatar bg-light-success p-50">
                                        <span class="avatar-content">
                                            <i data-feather="user-check" class="font-medium-4"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="fw-bolder mb-75">4</h3>
                                <span>In Active Users</span>
                            </div>
                            <div class="avatar bg-light-warning p-50">
                                        <span class="avatar-content">
                                            <i data-feather="user-x" class="font-medium-4"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="fw-bolder mb-75">4</h3>
                                <span>Pending Users</span>
                            </div>
                            <div class="avatar bg-light-danger p-50">
                                        <span class="avatar-content">
                                            <i data-feather="user-x" class="font-medium-4"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- list and filter start -->
            <div class="card">
                <div class="card-body border-bottom">

                    @include('admin.partials.session_msgs')

                    <h4 class="card-title">Search & Filter</h4>
                    <div class="row">
                        <div class="col-md-4 user_role"></div>
                        <div class="col-md-4 user_plan"></div>
                        <div class="col-md-4 user_status"></div>
                    </div>
                </div>
                <div class="card-datatable table-responsive pt-0">
                    <table class="user-list-table table">
                        <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($users as $user)

                            <tr @if($user->is_disabled) class="bg-secondary text-light" @endif>
                                <td>{{ $user->id }}</td>
                                <td>
                                    <div class="d-flex justify-content-left align-items-center">
                                        <div class="d-flex flex-column">
                                            <a href="{{ route('admin.user.detail',$user->id) }}"
                                               class="user_name {{ $user->is_disabled ? 'text-light' : 'text-body' }} "><span
                                                    class="fw-bolder">{{ $user->email }}</span></a>
                                            <small class="emp_post">{{ $user->name }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->department->title }}</td>
                                @if ($user->getRoleNames()->count())
                                    <td>{{ implode(',',$user->getRoleNames()->toArray()) }}</td>
                                @else
                                    <td>No Roles Assigned</td>
                                @endif
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-sm dropdown-toggle hide-arrow"
                                           data-bs-toggle="dropdown">
                                            <i data-feather="more-vertical" class="font-small-4"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">

                                            <a href="{{ route('admin.user.disable_enable_login',$user->id) }}"
                                               class="dropdown-item confirm-proceed">
                                                <i data-feather="file-text"
                                                   class="font-small-4 me-50"></i>{{ $user->is_disabled ? 'Enable ' : 'Disable ' }}
                                                Login</a>

                                            <a href="{{ route('admin.user.detail',$user->id) }}"
                                               class="dropdown-item">
                                                <i data-feather="file-text" class="font-small-4 me-50"></i>Detail</a>
                                            @if($user->id != auth()->id())
                                                <a href="#"
                                                   class="dropdown-item">
                                                    <i data-feather="file-text" class="font-small-4 me-50"></i>Impersonate</a>
                                            @endif

                                            <a href="javascript:void(0);"
                                               class="dropdown-item" data-bs-toggle="modal"
                                               data-id="{{$user->id}}"
                                               data-roles="{{ json_encode($user->roles->pluck('id')->toArray()) }}"
                                               data-bs-target="#assignrole">
                                                <i data-feather="file-text" class="font-small-4 me-50"></i>Assign
                                                Role</a>
                                            <a href="{{ route('admin.user.delete',$user->id) }}"
                                               class="dropdown-item confirm-proceed">
                                                <i data-feather="trash-2" class="font-small-4 me-50"></i>
                                                Delete</a></div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
                <!-- Modal to add new user starts-->
                @include('admin.users.modals.assign_role')
                @include('admin.users.modals.add')
                <!-- Modal to add new user Ends-->
            </div>
            <!-- list and filter end -->
        </section>
        <!-- users list ends -->

    </div>



@endsection

@section('scripts')

    <!-- BEGIN: Vendor JS-->
    <script src="{{ url('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ url('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/forms/cleave/cleave.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/forms/cleave/addons/cleave-phone.us.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ url('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ url('app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
{{--        <script src="{{ url('app-assets/js/scripts/pages/app-user-list.js?q='.time()) }}"></script>--}}
    <!-- END: Page JS-->
    <script>

        $('#user-employee').on('change', function () {

            var shift_id = $(this).find('option:selected').data('shift-id');

            $('#user-shift').find('option[value="' + shift_id + '"]').prop('selected', true).trigger('change');

        });


        $("#assignrole").on('show.bs.modal', function (e) {
            var element = $(e.relatedTarget);
            var user_id = element.data('id');

            var user_roles = element.data('roles');

            $(this).find('.user_id').val(user_id);

            var roles_html = '<option value="">Select Role</option>';

            @foreach ($roles as $role)

            var role = {{ $role->id }};

            var selected = $.inArray(role, user_roles) >= 0 ? 'selected' : '';

            roles_html += '<option value="{{ $role->name }}" ' + selected + '>{{ $role->name }}</option>';

            @endforeach

            $(this).find('#assign-role').html(roles_html);


        });


        var table = $('.user-list-table').DataTable({

            // "bDestroy": true

            order: [[1, 'desc']],
            dom:
                '<"d-flex justify-content-between align-items-center header-actions mx-2 row mt-75"' +
                '<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" l>' +
                '<"col-sm-12 col-lg-8 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap"<"me-1"f>B>>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: 'Show _MENU_',
                search: 'Search',
                searchPlaceholder: 'Search..'
            },
            // Buttons with Dropdown
            buttons: [

                {
                    text: 'Add New User',
                    className: 'add-new btn btn-primary',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#modals-slide-in'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }
                }
            ],


        });
        table.on('draw', function () {
            feather.replace({
                width: 14,
                height: 14
            });
        });
        $(window).on('load', function () {

            $('select').select2();
            $('body').find('#modals-slide-in select').select2({dropdownParent: "#modals-slide-in"});
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })

    </script>
@endsection
