@extends('admin.layouts.master')
@section('title', 'Products List')
@section('content')

    <!-- BEGIN: Content-->
    @can('product.view')
        <div class="content-body">
            @include('admin.partials.session_msgs')
            <h3>Products List</h3>

            <!-- Product Table -->
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="datatables-products table">
                        <thead class="table-light">
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                 <th>Total Stock</th>
                                <th>Available Stock</th>
                                <th>Brand</th>
                                @canany(['product.edit', 'product.delete'])
                                    <th>Actions</th>
                                @endcanany
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($products as $product)
                                @php $description = $product->description; @endphp
                                @php $description_length = strlen($description); @endphp

                                <tr>
                                    <td>{{ $product->title }}</td>

                                    @if ($description_length > 100)
                                        @php $description = substr($description, 0, 100); @endphp
                                        <td class="read-more-description">
                                            {{ $description . '....' }}
                                            <a style="margin-left: 30px;" href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#viewDescriptionModal"
                                                data-description="{{ $product->description }}">Read More</a>
                                        </td>
                                    @else
                                        <td>{{ $product->description }}</td>
                                    @endif
                                     <td>{{ $product->productitems->count()}}</td>
                                      <td>{{ $product->productitems->where('employee_id',null)->count() }}</td>
                                    <td>{{ $product->brand->title }}</td>


                                    <td>

<div class="btn-group">
            <a class="btn btn-sm dropdown-toggle hide-arrow"
               data-bs-toggle="dropdown">
                <i data-feather="more-vertical" class="font-small-4"></i></a>
            <div class="dropdown-menu dropdown-menu-end">

                <a href="{{ route('product.edit', $product->id) }}"
                   class="dropdown-item " >
                    <i data-feather="file-text"
                       class="font-small-4 me-50"></i>
                    Edit</a>

                <a href="{{ route('product.delete', $product->id) }}"
                
                   class="dropdown-item confirm-proceed">
                    <i data-feather="file-text" class="font-small-4 me-50"></i>Delete</a>
              
            

            


                     <a href="{{ route('productitem.list', $product->id) }}"
                       class="dropdown-item">
                        <i data-feather="file-text" class="font-small-4 me-50"></i>View Item</a>
             

          
        </div>


</td>




                                    <!-- @canany(['product.edit', 'product.delete'])
                                        <td>
                                            @can('product.edit')
                                                <a href="{{ route('product.edit', $product->id) }}"
                                                    data-product-id="{{ $product->id }}"><i data-feather="edit"
                                                        class="font-medium-2 text-body"></i></a>
                                            @endcan

                                            @can('product.delete')
                                                <a class="delete_product" href="{{ route('product.delete', $product->id) }}"><i
                                                        data-feather="trash" class="font-medium-2 text-body"></i></a>
                                            @endcan

                                            @can('product.edit')
                                                <a href="{{ route('productitem.list', $product->id) }}">
                                                    <button class="btn-primary">View Item</button>
                                                </a>

                                                {{-- <a href="{{ route('product.productitem.list', $product->id) }}">
                                                    <button class="btn-primary">View Item</button>
                                                </a> --}}

                                                {{-- <a href="{{ route('product.productitem.list', $product->id) }}"
                                           data-product-id="{{ $product->id }}"><i
                                                    data-feather="edit" class="font-medium-2 text-body"></i></a> --}}
                                            @endcan

                                        </td>
                                    @endcanany -->
                                </tr>
                            @endforeach
                        </tbody>


                    </table>
                </div>
            </div>
            <!--/ Product Table -->
        </div>
    @endcan

    @include('admin.brands.modals.view_description')

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

            var dataTablePermissions = $('.datatables-products');
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
                    text: 'Add Product',
                    className: 'add-new btn btn-primary mt-50',
                    attr: {
                        // 'data-bs-toggle': 'modal',
                        // 'data-bs-target': '#addBrandModal',
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
                var $this = $(this);
                window.location = '{{ route('product.add') }}';
            });

            @can('product.view')
                $('#viewDescriptionModal').on('show.bs.modal', function(e) {
                    var btn = $(e.relatedTarget);
                    var description = btn.data('description');

                    $('.complete-description').text(description);
                });
            @endcan

            @can('product.delete')
                $('body').on('click', '.delete_product', function(e) {
                    var $this = $(this); 

                    if (confirm('Are you sure you want to proceed?')) {} else {
                        return false;
                    }

                });
            @endcan




        });



    </script>
@endsection
