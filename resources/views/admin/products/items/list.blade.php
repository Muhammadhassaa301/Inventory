@extends('admin.layouts.master')
@section('title', 'Product Items List')
@section('content')

    <!-- BEGIN: Content-->
    @can('product_item.view')
        <div class="content-body">
            {{--  <div class="message_status"></div> --}}
            @include('admin.partials.session_msgs')
            <h3>Product Items List</h3>

            <!-- Product Item Table -->
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="datatables-product-items table">
                        <thead class="table-light">
                            <tr>
                                <th>Ser #</th>
                                <th>Product Code</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Variation</th>
                                <th>Employee</th>
                                @canany(['product_item.edit', 'product_item.delete'])
                                    <th>Actions</th>
                                @endcanany
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($productitems as $item)
                                <tr>
                                    <td>{{ $item->serial_no }}</td>
                                    <td>{{ $item->product_code }}</td>
                                    <td>{{ $item->product->title }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->variation->title ?? '-' }}</td>
                                    <td>{{$item->employee->full_name ?? '-'}}</td>
                                    <td>

                                    <div class="btn-group">
                                                <a class="btn btn-sm dropdown-toggle hide-arrow"
                                                   data-bs-toggle="dropdown">
                                                    <i data-feather="more-vertical" class="font-small-4"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">

                                                    <a href="{{  route('productitem.edit', $item->id) }}"
                                                       class="dropdown-item ">
                                                        <i data-feather="file-text"
                                                           class="font-small-4 me-50"></i>
                                                        Edit</a>

                                                    <a href="{{ route('productitem.delete', $item->id) }}"
                                                       class="dropdown-item confirm-proceed">
                                                        <i data-feather="file-text" class="font-small-4 me-50"></i>Delete</a>
                                                  
                                                

                                                            <a href=""
                                                            class="dropdown-item"
                                                            data-bs-toggle= "modal",
                                                         
                         data-bs-target= "#assignEmployeeModal" data-productitem-id = "{{$item->id}}"
                                                          
                                                         >   <i data-feather="file-text"  class="font-small-4 me-50"></i>Assign Employee</a>


                                                         <a href="{{ route('producthistory.list', $item->id) }}"
                                                           class="dropdown-item">
                                                            <i data-feather="file-text" class="font-small-4 me-50"></i>View History</a>
                                                 

                                              
                                            </div>
                            

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>


                    </table>
                </div>
            </div>
            <!--/ Product Item Table -->
        </div>
    @endcan

    @include('admin.products.modals.assign')


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

            var dataTablePermissions = $('.datatables-product-items');
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
                    text: 'Assign Employee',
                    className: 'add-new btn btn-primary mt-50 d-none' ,
                    attr: {
                        // 'data-bs-toggle': 'modal',
                        // 'data-bs-target': '#assignEmployeeModal'
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

            // $('body').on('click', '.add-new', function() {
            //     window.location = '{{ route('invoice.add') }}';
            // });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#assignEmployeeModal').on('show.bs.modal', function (e) {                 
                var btn = $(e.relatedTarget);
                var $this = $(this);
                var productitem_id = btn.data('productitem-id');
                $this.find('.assign_user').html('<div class="text-center"><div class="spinner-border" role="status"> <span class="visually-hidden">Loading...</span></div></div>');

                var route = '{{ route('productitem.get.employee') }}';

                $.ajax({
                    type: "GET",
                    url: route,
                    data: {productitem_id:productitem_id},
                    success: function (response) {
                        $('.assign_user').html(response.html);
                    }
                });
            });


            $('body').on('click', '.delete_item', function(e) {
                var $this = $(this);
                if (confirm('Are you sure you want to proceed?')) {

                } else {
                    return false;
                }
            });


           $(window).on('load', function () {

$('#assign-user').select2();
$('body').find('#modals-slide-in select').select2({dropdownParent: "#modals-slide-in"});
if (feather) {
    feather.replace({
        width: 14,
        height: 14
    });
}
});



        });
    </script>
@endsection
