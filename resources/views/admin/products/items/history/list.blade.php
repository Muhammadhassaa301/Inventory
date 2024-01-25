@extends('admin.layouts.master')
@section('title', 'Invoices List')
@section('content')

    <!-- BEGIN: Content-->
    @can('invoice.view')
        <div class="content-body">
            {{--  <div class="message_status"></div> --}}
            @include('admin.partials.session_msgs')
            <h3>Product Item Maintenance History</h3>
            <h3>{{ $ProdInfo['ProdName'] }}</h3>

            <!-- Invoice Table -->
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="datatables-invoices table">
                        <thead class="table-light">
                            <tr>
                                <th>TITLE</th>
                                <th>DESCRIPTION</th>
                                <th>Amount</th>
                                @canany(['invoice.edit', 'invoice.delete'])
                                    <th>Actions</th>
                                @endcanany
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($pmh as $v)
                                <tr>
                                    <td>{{ $v->title }}</td>
                                    <td>{{ $v->description }}</td>
                                    <td>{{ $v->amount }}</td>

                                    <td>
                                        @can('product_item.edit')
                                            <a href="javascript:void(0)" data-bs-toggle="modal" data-item_id={{ $v->id }}
                                                data-bs-target="#editProductItemHistoryModal"><i data-feather="edit"
                                                    class="font-medium-2 text-body"></i></a>
                                        @endcan

                                        {{-- admin.products.items.history.list --}}
                                        @can('product_item.delete')
                                            <a class="delete_history"
                                                href="{{ route('producthistory.delete', $v->id) }}"><i
                                                    data-feather="trash" class="font-medium-2 text-body"></i></a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>


                    </table>
                </div>
            </div>
            <!--/ Invoice Table -->
        </div>
    @endcan
    {{--      admin.products.items.history.list --}}
    {{--     admin.products.items.history.modals.add --}}
    @include('admin.products.items.history.modals.add')
    @include('admin.products.items.history.modals.edit')

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
        $(document).ready(function() {

            var dataTablePermissions = $('.datatables-invoices');
            dt_permission = dataTablePermissions.DataTable({

                order: [
                    [1, 'asc']
                ],
                dom: '<"d-flex justify-content-between align-items-center header-actions text-nowrap mx-1 row mt-75"' +
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
                buttons: [{
                    text: 'Add History',
                    className: 'add-new btn btn-primary mt-50',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#addHistoryModal'
                    },
                    init: function(api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }
                }],
                language: {
                    paginate: {
                        // remove previous & next text from pagination
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    }
                },
                initComplete: function() {
                    // Adding role filter once table initialized
                    this.api()
                    // .columns(1)
                    // .every(function () {
                    //     var column = this;
                    //     var select = $(
                    //         '<select id="UserRole" class="form-select text-capitalize">' + roles + '</select>'
                    //     )
                    //         .appendTo('.user_role')
                    //         .on('change', function () {
                    //             var val = $.fn.dataTable.util.escapeRegex($(this).val());
                    //             column.search(val ? val : '', true, false).draw();
                    //         });
                    // });
                }
            });

            dt_permission.on('draw', function() {
                feather.replace({
                    width: 14,
                    height: 14
                });
            });

            $(window).on('load', function() {
                if (feather) {
                    feather.replace({
                        width: 14,
                        height: 14
                    });
                }
            });

            $('body').on('click', '.add-new', function() {

                // var s = '';
                // console.log($ProdInfo['ProductItemID']);
                //console.log('Action');

                //window.location = '{{ route('invoice.productitem.history.addhistory', $ProdInfo['ProductItemID']) }}';
                //window.location = '{{ route('invoice.add') }}';
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('body').on('click', '.delete_history', function(e) {
                var $this = $(this);
                if (confirm('Are you sure you want to proceed?')) {

                } else {
                    return false;
                }
            });


            $('#editProductItemHistoryModal').on('show.bs.modal', function(e) { // View Single Department
                var btn = $(e.relatedTarget);
                var $this = $(this);
                var history_id = btn.data('item_id');

                var htm =
                    '<div class="text-center"><div class="spinner-border" role="status"> <span class="visually-hidden">Loading...</span></div></div>';

                $this.find('.edit_history').html(htm);

                var route = '{{ route('producthistory.edit', ':history_id') }}';
                route = route.replace(':history_id', history_id);

                $.ajax({
                    type: "GET",
                    url: route,
                    data: {
                        history_id: history_id
                    },
                    success: function(response) {
                        $('.edit_history').html(response.html);
                    }
                });
            });

        });
    </script>
@endsection
