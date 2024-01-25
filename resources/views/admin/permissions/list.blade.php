@extends('admin.layouts.master')
@section('title','Permissions List')
@section('content')

    <!-- BEGIN: Content-->

    <div class="content-body">
        @include('admin.partials.session_msgs')
        <h3>Permissions List</h3>
        <p>Each category (Basic, Professional, and Business) includes the four predefined roles shown below.</p>

        <!-- Permission Table -->
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="datatables-permissions table">
                    <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Module</th>
                        <th>Assigned To</th>
                        <th>Created Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($permissions as $permission)

                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>{{ \App\Models\Module::find($permission->module_id)?->name }}</td>
                            @if ($permission->getRoleNames()->count())
                                <td>
                                    @foreach ($permission->getRoleNames() as $rolename)

                                        <div class="badge rounded-pill bg-primary">{{ $rolename }}</div>
                                    @endforeach

                                </td>
                            @else
                                <td>Not Assigned Yet</td>
                            @endif

                            <td>{{ $permission->created_at }}</td>
                            <td>
                                <a href="javascript:void(0)" class="permission-{{ $permission->id }}"
                                   data-bs-toggle="modal"
                                   data-bs-target="#editPermissionModal" data-id="{{$permission->id}}"
                                   data-name="{{$permission->name}}"
                                   data-module_id="{{$permission->module_id}}"><i
                                        data-feather="edit" class="font-medium-2 text-body"></i></a>
                                <a href="{{ route('admin.permission.delete',$permission->id) }}"
                                   class="confirm-proceed"><i data-feather="trash"
                                                              class="font-medium-2 text-body"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>


                </table>
            </div>
        </div>
        <!--/ Permission Table -->
        <!-- Add Permission Modal -->
        @include('admin.permissions.modals.update')
        @include('admin.permissions.modals.add')
        @include('admin.permissions.modals.addmodule')
        <!--/ Add Permission Modal -->
        <!-- Edit Permission Modal -->

        <!--/ Edit Permission Modal -->

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
    <!-- END: Page JS-->
    <script>

        $("#editPermissionModal").on('show.bs.modal', function (e) {

            var $this = $(this);

            var btn = $(e.relatedTarget);

            var permission_id = btn.data('id');
            var permission_name = btn.data('name');
            var module_id = btn.data('module_id');


            if (permission_id != undefined)
                $this.find('.permission_id').val(permission_id);

            if (permission_name != undefined)
                $this.find('#editPermissionName').val(permission_name);

            if (module_id != undefined)
                $this.find('#moduleedit option[value="' + module_id + '"]').prop('selected', true).trigger('change');

        });

        $("#addmodulemodal").on('show.bs.modal', function (e) {

            var $this = $(this);

            var btn = $(e.relatedTarget);

            var activeModal = btn.data('active-modal');
            var permission_name = btn.data('permission_name');

            $this.find('.active_modal').val(activeModal);
            $this.find('.permission_name').val(permission_name);
            $(activeModal).modal('hide');
        });

        $('.add-new-module').on('submit', function (e) {
            e.preventDefault();

            var $this = $(this);

            var title = $this.find('[name="title"]').val();
            var token = $this.find('[name="_token"]').val();
            var active_modal = $this.find('.active_modal').val();

            var btn = $this.find('.add_module_btn');

            btn.html('Please wait....');
            btn.prop('disabled', true);

            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: {name: title, _token: token, is_ajax: 1}
            }).done(function (data) {

                if (data.success) {

                    $(active_modal).find('.module').append('<option value="' + data.module.id + '" selected>' + data.module.name + '</option>');

                    $(active_modal).modal('show');

                    $('#addmodulemodal').modal('hide');

                } else {
                    alert(data.message)
                }

                btn.html('Submit');
                btn.prop('disabled', false);

            });


        });


        var roles = '<option value="">Select Role</option>';

        @foreach($roles as $role)
            roles += "<option value='{{ $role->name }}'>{{ $role->name }}</option>";
        @endforeach

        var dataTablePermissions = $('.datatables-permissions');
        dt_permission = dataTablePermissions.DataTable({
            // ajax: assetPath + 'data/permissions-list.json', // JSON file to add data

            order: [[1, 'asc']],
            dom:
                '<"d-flex justify-content-between align-items-center header-actions text-nowrap mx-1 row mt-75"' +
                '<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" l>' +
                '<"col-sm-12 col-lg-8"<"dt-action-buttons d-flex align-items-center justify-content-lg-end justify-content-center flex-md-nowrap flex-wrap"<"me-1"f><"user_role mt-50 width-200 me-1">B>>' +
                '><"text-nowrap" t>' +
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
                    text: 'Add Permission',
                    className: 'add-new btn btn-primary mt-50',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#addPermissionModal'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }
                }
            ],
            // For responsive popup
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return 'Details of Permission';
                        }
                    }),
                    type: 'column',
                    renderer: function (api, rowIdx, columns) {
                        var data = $.map(columns, function (col, i) {
                            return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                                ? '<tr data-dt-row="' +
                                col.rowIndex +
                                '" data-dt-column="' +
                                col.columnIndex +
                                '">' +
                                '<td>' +
                                col.title +
                                ':' +
                                '</td> ' +
                                '<td>' +
                                col.data +
                                '</td>' +
                                '</tr>'
                                : '';
                        }).join('');

                        return data ? $('<table class="table"/><tbody />').append(data) : false;
                    }
                }
            },
            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            },
            initComplete: function () {
                // Adding role filter once table initialized
                this.api()
                    .columns(1)
                    .every(function () {
                        var column = this;
                        var select = $(
                            '<select id="UserRole" class="form-select text-capitalize">' + roles + '</select>'
                        )
                            .appendTo('.user_role')
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? val : '', true, false).draw();
                            });
                    });
            }
        });


        dt_permission.on('draw', function () {
            feather.replace({
                width: 14,
                height: 14
            });
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
