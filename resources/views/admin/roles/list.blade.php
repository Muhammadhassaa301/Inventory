@extends('admin.layouts.master')
@section('title','Roles List')
@section('content')

<!-- BEGIN: Content-->

        <div class="content-body">
            @include('admin.partials.session_msgs')

            <h3>Roles List</h3>
            <p class="mb-2">
                A role provided access to predefined menus and features so that depending <br />
                on assigned role an administrator can have access to what he need
            </p>

{{--            <!-- Role cards -->--}}
            <div class="row">
                @foreach($roles as $role)
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <span>Total {{ $role->users->count() }} users</span>

                            </div>
                            <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                                <div class="role-heading">
                                    <h4 class="fw-bolder">{{ $role->name }}</h4>
                                    <a href="javascript:;" class="role-edit-modal" data-bs-toggle="modal" data-bs-target="#editrole{{$role->id}}">
                                        <small class="fw-bolder">Edit Role</small>
                                    </a>
                                </div>
                                <a href="{{ route('admin.role.delete',$role->id) }}" class="text-body confirm-proceed"
                                   title="Delete Role"><i data-feather="trash" class="font-medium-5"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                    @include('admin.roles.modals.update')
                @endforeach

                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="d-flex align-items-end justify-content-center h-100">
                                    <img src="../../../app-assets/images/illustration/faq-illustrations.svg" class="img-fluid mt-2" alt="Image" width="85" />
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="card-body text-sm-end text-center ps-sm-0">
                                    <a href="javascript:void(0)" data-bs-target="#addRoleModal" data-bs-toggle="modal" class="stretched-link text-nowrap add-new-role">
                                        <span class="btn btn-primary mb-1">Add New Role</span>
                                    </a>
                                    <p class="mb-0">Add role, if it does not exist</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- table -->
            <div class="card">
                <div class="card-datatable table-responsive pt-0">

                </div>

            </div>
            <!-- table -->

            <!-- Add Role Modal -->
            @include('admin.roles.modals.add')
            <!--/ Add Role Modal -->

        </div>

<!-- END: Content-->

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
    <script src="{{ url('app-assets/js/scripts/pages/app-user-list.js?q='.time()) }}"></script>

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->
    <script>
        $('body').on('click', '#selectAll', function () {
            var checked = $(this).prop('checked');
            if (checked) {
                $("input[type='checkbox']").prop('checked', true);
            } else {
                $("input[type='checkbox']").prop('checked', false);
            }
        });
        $(window).on('load', function () {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
@endsection


