@extends('admin.layouts.master')
@section('title','User Detail')
@section('content')

    <!-- BEGIN: Content-->

    <div class="content-body">
        <section class="app-user-view-account">
            <div class="row">
                <!-- User Sidebar -->
                <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                    <!-- User Card -->
                    <div class="card">
                        <div class="card-body">
                            <div class="user-avatar-section">
                                <div class="d-flex align-items-center flex-column">
                                    <img class="img-fluid rounded mt-3 mb-2"
                                         src="../../../app-assets/images/portrait/small/avatar-s-2.jpg"
                                         height="110" width="110" alt="User avatar"/>
                                    <div class="user-info text-center">
                                        <h4>{{ $user->name }}</h4>
                                        <span class="badge bg-light-secondary">Default</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-around my-2 pt-75">
                                <div class="d-flex align-items-start me-2">
                                            <span class="badge bg-light-primary p-75 rounded">
                                                <i data-feather="check" class="font-medium-2"></i>
                                            </span>
                                    <div class="ms-75">
                                        <h4 class="mb-0">1.23k</h4>
                                        <small>Tasks Done</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start">
                                            <span class="badge bg-light-primary p-75 rounded">
                                                <i data-feather="briefcase" class="font-medium-2"></i>
                                            </span>
                                    <div class="ms-75">
                                        <h4 class="mb-0">568</h4>
                                        <small>Projects Done</small>
                                    </div>
                                </div>
                            </div>
                            <h4 class="fw-bolder border-bottom pb-50 mb-1">Details</h4>
                            <div class="info-container">
                                <ul class="list-unstyled">
                                    <li class="mb-75">
                                        <span class="fw-bolder me-25">Name:</span>
                                        <span>{{ $user->name }}</span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="fw-bolder me-25">Email:</span>
                                        <span>{{ $user->email }}</span>
                                    </li>
{{--                                    <li class="mb-75">--}}
{{--                                        <span class="fw-bolder me-25">Status:</span>--}}
{{--                                        <span--}}
{{--                                            class="badge @if($user->status == 'active') bg-light-success @elseif($user->status == 'in_active') bg-light-secondary @else bg-light-danger @endif">{{ $user->formatted_status() }}</span>--}}
{{--                                    </li>--}}
                                    <li class="mb-75">
                                        <span class="fw-bolder me-25">Role:</span>
                                        <span>Default</span>
                                    </li>
                                    {{--                                            <li class="mb-75">--}}
                                    {{--                                                <span class="fw-bolder me-25">Tax ID:</span>--}}
                                    {{--                                                <span>Tax-8965</span>--}}
                                    {{--                                            </li>--}}
{{--                                    <li class="mb-75">--}}
{{--                                        <span class="fw-bolder me-25">Contact:</span>--}}
{{--                                        <span>{{ $user->phone }}</span>--}}
{{--                                        <span>846564656</span>--}}
{{--                                    </li>--}}
                                    <li class="mb-75">
                                        <span class="fw-bolder me-25">Language:</span>
                                        <span>English</span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="fw-bolder me-25">Country:</span>
                                        <span>Wake Island</span>
                                    </li>
                                </ul>
                                <div class="d-flex justify-content-center pt-2">
                                    <a href="javascript:;" class="btn btn-primary me-1"
                                       data-bs-target="#editUser" data-bs-toggle="modal">
                                        Edit
                                    </a>
                                    <a href="javascript:;"
                                       class="btn btn-outline-danger suspend-user">Suspended</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /User Card -->
                    <!-- Plan Card -->
                    <div class="card border-primary">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <span class="badge bg-light-primary">Standard</span>
                                <div class="d-flex justify-content-center">
                                    <sup class="h5 pricing-currency text-primary mt-1 mb-0">$</sup>
                                    <span class="fw-bolder display-5 mb-0 text-primary">99</span>
                                    <sub class="pricing-duration font-small-4 ms-25 mt-auto mb-2">/month</sub>
                                </div>
                            </div>
                            <ul class="ps-1 mb-2">
                                <li class="mb-50">10 Users</li>
                                <li class="mb-50">Up to 10 GB storage</li>
                                <li>Basic Support</li>
                            </ul>
                            <div class="d-flex justify-content-between align-items-center fw-bolder mb-50">
                                <span>Days</span>
                                <span>4 of 30 Days</span>
                            </div>
                            <div class="progress mb-50" style="height: 8px">
                                <div class="progress-bar" role="progressbar" style="width: 80%"
                                     aria-valuenow="65" aria-valuemax="100" aria-valuemin="80"></div>
                            </div>
                            <span>4 days remaining</span>
                            <div class="d-grid w-100 mt-2">
                                <button class="btn btn-primary" data-bs-target="#upgradePlanModal"
                                        data-bs-toggle="modal">
                                    Upgrade Plan
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /Plan Card -->
                </div>
                <!--/ User Sidebar -->

                <!-- User Content -->
                <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                    <!-- User Pills -->
                    <ul class="nav nav-pills mb-2">
                        <li class="nav-item">
                            <a class="nav-link active" href="app-user-view-account.html">
                                <i data-feather="user" class="font-medium-3 me-50"></i>
                                <span class="fw-bold">Account</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="app-user-view-security.html">
                                <i data-feather="lock" class="font-medium-3 me-50"></i>
                                <span class="fw-bold">Security</span>
                            </a>
                        </li>
                        {{--                                <li class="nav-item">--}}
                        {{--                                    <a class="nav-link" href="app-user-view-billing.html">--}}
                        {{--                                        <i data-feather="bookmark" class="font-medium-3 me-50"></i>--}}
                        {{--                                        <span class="fw-bold">Billing & Plans</span>--}}
                        {{--                                    </a>--}}
                        {{--                                </li>--}}
                        <li class="nav-item">
                            <a class="nav-link" href="app-user-view-notifications.html">
                                <i data-feather="bell" class="font-medium-3 me-50"></i><span class="fw-bold">Notifications</span>
                            </a>
                        </li>
                        {{--                                <li class="nav-item">--}}
                        {{--                                    <a class="nav-link" href="app-user-view-connections.html">--}}
                        {{--                                        <i data-feather="link" class="font-medium-3 me-50"></i><span class="fw-bold">Connections</span>--}}
                        {{--                                    </a>--}}
                        {{--                                </li>--}}
                    </ul>
                    <!--/ User Pills -->

                    <!-- Project table -->
                    <div class="card">
                        <h4 class="card-header">User's Projects List</h4>
                        <div class="table-responsive">
                            <table class="table datatable-project">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Project</th>
                                    <th class="text-nowrap">Total Task</th>
                                    <th>Progress</th>
                                    <th>Hours</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <!-- /Project table -->

                    <!-- Activity Timeline -->
                    <div class="card">
                        <h4 class="card-header">User Activity Timeline</h4>
                        <div class="card-body pt-1">
                            <ul class="timeline ms-50">
                                <li class="timeline-item">
                                    <span class="timeline-point timeline-point-indicator"></span>
                                    <div class="timeline-event">
                                        <div
                                            class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                            <h6>User login</h6>
                                            <span class="timeline-event-time me-1">12 min ago</span>
                                        </div>
                                        <p>User login at 2:12pm</p>
                                    </div>
                                </li>
                                <li class="timeline-item">
                                            <span
                                                class="timeline-point timeline-point-warning timeline-point-indicator"></span>
                                    <div class="timeline-event">
                                        <div
                                            class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                            <h6>Meeting with john</h6>
                                            <span class="timeline-event-time me-1">45 min ago</span>
                                        </div>
                                        <p>React Project meeting with john @10:15am</p>
                                        <div class="d-flex flex-row align-items-center mb-50">
                                            <div class="avatar me-50">
                                                <img
                                                    src="../../../app-assets/images/portrait/small/avatar-s-7.jpg"
                                                    alt="Avatar" width="38" height="38"/>
                                            </div>
                                            <div class="user-info">
                                                <h6 class="mb-0">Leona Watkins (Client)</h6>
                                                <p class="mb-0">CEO of pixinvent</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-item">
                                            <span
                                                class="timeline-point timeline-point-info timeline-point-indicator"></span>
                                    <div class="timeline-event">
                                        <div
                                            class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                            <h6>Create a new react project for client</h6>
                                            <span class="timeline-event-time me-1">2 day ago</span>
                                        </div>
                                        <p>Add files to new design folder</p>
                                    </div>
                                </li>
                                <li class="timeline-item">
                                            <span
                                                class="timeline-point timeline-point-danger timeline-point-indicator"></span>
                                    <div class="timeline-event">
                                        <div
                                            class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                            <h6>Create Invoices for client</h6>
                                            <span class="timeline-event-time me-1">12 min ago</span>
                                        </div>
                                        <p class="mb-0">Create new Invoices and send to Leona Watkins</p>
                                        <div class="d-flex flex-row align-items-center mt-50">
                                            <img class="me-1" src="../../../app-assets/images/icons/pdf.png"
                                                 alt="data.json" height="25"/>
                                            <h6 class="mb-0">Invoices.pdf</h6>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /Activity Timeline -->

                    <!-- Invoice table -->
                    <div class="card">
                        <table class="invoice-table table text-nowrap">
                            <thead>
                            <tr>
                                <th></th>
                                <th>#ID</th>
                                <th><i data-feather="trending-up"></i></th>
                                <th>TOTAL Paid</th>
                                <th class="text-truncate">Issued Date</th>
                                <th class="cell-fit">Actions</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /Invoice table -->
                </div>
                <!--/ User Content -->
            </div>
        </section>
        <!-- Edit User Modal -->
        @include('admin.users.modals.update')
        <!--/ Edit User Modal -->
        <!-- upgrade your plan Modal -->
        <div class="modal fade" id="upgradePlanModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-upgrade-plan">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-5 pb-2">
                        <div class="text-center mb-2">
                            <h1 class="mb-1">Upgrade Plan</h1>
                            <p>Choose the best plan for user.</p>
                        </div>
                        <form id="upgradePlanForm" class="row pt-50" onsubmit="return false">
                            <div class="col-sm-8">
                                <label class="form-label" for="choosePlan">Choose Plan</label>
                                <select id="choosePlan" name="choosePlan" class="form-select"
                                        aria-label="Choose Plan">
                                    <option selected>Choose Plan</option>
                                    <option value="standard">Standard - $99/month</option>
                                    <option value="exclusive">Exclusive - $249/month</option>
                                    <option value="Enterprise">Enterprise - $499/month</option>
                                </select>
                            </div>
                            <div class="col-sm-4 text-sm-end">
                                <button type="submit" class="btn btn-primary mt-2">Upgrade</button>
                            </div>
                        </form>
                    </div>
                    <hr/>
                    <div class="modal-body px-5 pb-3">
                        <h6>User current plan is standard plan</h6>
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="d-flex justify-content-center me-1 mb-1">
                                <sup class="h5 pricing-currency pt-1 text-primary">$</sup>
                                <h1 class="fw-bolder display-4 mb-0 text-primary me-25">99</h1>
                                <sub class="pricing-duration font-small-4 mt-auto mb-2">/month</sub>
                            </div>
                            <button class="btn btn-outline-danger cancel-subscription mb-1">Cancel
                                Subscription
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ upgrade your plan Modal -->

    </div>



@endsection

@section('scripts')

    <!-- BEGIN: Vendor JS-->
    <script src="{{ url('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ url('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/forms/cleave/cleave.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/forms/cleave/addons/cleave-phone.us.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/extensions/moment.min.js') }}"></script>
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
    <script src="{{ url('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/extensions/polyfill.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ url('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ url('app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ url('app-assets/js/scripts/pages/modal-edit-user.js') }}"></script>
    <script src="{{ url('app-assets/js/scripts/pages/app-user-view-account.js') }}"></script>
    <script src="{{ url('app-assets/js/scripts/pages/app-user-view.js') }}"></script>
    <!-- END: Page JS-->

    <script>

        $('#user-employee').on('change', function () {

            var shift_id = $(this).find('option:selected').data('shift-id');

            $('#user-shift').find('option[value="' + shift_id + '"]').prop('selected',true).trigger('change');

        });

        $(window).on('load', function () {
            $('select').select2();
            $('body').find('#editUser select').select2({dropdownParent: "#editUser"});



            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
@endsection
