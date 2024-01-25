@extends('admin.layouts.master')
@section('title','Brands List')
@section('content')

    <!-- BEGIN: Content-->
    @can('brand.view')
        <div class="content-body">
            <div class="message_status"></div>
            @include('admin.partials.session_msgs')
            <h3>Brands List</h3>

            <!-- Brand Table -->
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="datatables-brands table">
                        <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            @canany(['brand.edit','brand.delete'])
                                <th>Actions</th>
                            @endcanany
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($brands as $brand)
                            @php $description = $brand->description; @endphp
                            @php $description_length = strlen($description); @endphp

                            <tr>
                                <td>{{ $brand->title }}</td>

                                @if($description_length > 100)
                                    @php $description = substr($description, 0, 100); @endphp
                                    <td class="read-more-description">
                                        {{ $description . "...." }}
                                        <a style="margin-left: 30px;" href="javascript:void(0)" data-bs-toggle="modal"
                                           data-bs-target="#viewDescriptionModal"
                                           data-description="{{ $brand->description }}">Read More</a>
                                    </td>
                                @else
                                    <td>{{ $description }}</td>
                                @endif

                                @canany(['brand.edit','brand.delete'])
                                    <td>
                                        @can('brand.edit')
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                               data-bs-target="#editBrandModal" data-brand-id="{{ $brand->id }}"><i
                                                    data-feather="edit" class="font-medium-2 text-body"></i></a>
                                        @endcan

                                        @can('brand.delete')
                                            <a class="delete_brand" href="{{ route('brand.delete', $brand->id) }}"><i
                                                    data-feather="trash"
                                                    class="font-medium-2 text-body"></i></a>
                                        @endcan
                                    </td>
                                @endcanany
                            </tr>
                        @endforeach
                        </tbody>


                    </table>
                </div>
            </div>
            <!--/ Brand Table -->
        </div>
    @endcan

    @include('admin.brands.modals.add')
    @include('admin.brands.modals.edit')
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

        $(document).ready(function () {

            var dataTablePermissions = $('.datatables-brands');
            dt_permission = dataTablePermissions.DataTable({

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
                        text: 'Add Brand',
                        className: 'add-new btn btn-primary mt-50',
                        attr: {
                            'data-bs-toggle': 'modal',
                            'data-bs-target': '#addBrandModal'
                        },
                        init: function (api, node, config) {
                            $(node).removeClass('btn-secondary');
                        }
                    }
                ],
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
            });

            @can('brand.view')
            $('#viewDescriptionModal').on('show.bs.modal', function (e) {               // View Complete Description of Brand (Read More)
                var btn = $(e.relatedTarget);
                var description = btn.data('description');

                $('.complete-description').text(description);
            });
            @endcan

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            @can('brand.add')
            if(localStorage.getItem("Status"))
            {
                $('.message_status').addClass('alert alert-success');
                $('.message_status').html(localStorage.getItem("Status"));
                localStorage.clear();
            }

            $('body').on('submit', '#add-brand-form', function (e) {           // Add Brand
                e.preventDefault();
                var $this = $(this);

                var route = '{{ route('brand.store') }}';

                $.ajax({
                    type: "POST",
                    url: route,
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if(response.success) {
                            window.location.reload();
                            localStorage.setItem("Status",response.message);
                        }
                    },
                    error: function (response) {
                        var error = response.responseJSON.error;
                        var title = $this.find('#modalAddTitle');
                        title.addClass('is-invalid');
                        title.parent().find('.text-danger').removeClass('d-none');
                        title.parent().find('.text-danger').html(error);
                    },

                });

            });

            $('body').on('keypress', '#modalAddTitle', function () {
                var $this = $(this);

                $this.hasClass('is-invalid') ? $this.removeClass('is-invalid') : '';
                $this.parent().find('.text-danger').addClass('d-none');
            });
            @endcan

            @can('brand.edit')
            $('#editBrandModal').on('show.bs.modal', function (e) {                 // View Single Brand
                var btn = $(e.relatedTarget);
                var $this = $(this);
                var brand_id = btn.data('brand-id');
                $this.find('.edit_brand').html('<div class="text-center"><div class="spinner-border" role="status"> <span class="visually-hidden">Loading...</span></div></div>');

                var route = '{{ route('brand.edit',':brand_id') }}';
                route = route.replace(':brand_id', brand_id);

                $.ajax({
                    type: "GET",
                    url: route,
                    data: {brand_id: brand_id},
                    success: function (response) {
                        $('.edit_brand').html(response.html);
                    }
                });
            });

            $('body').on('submit', '#edit-brand-form', function (e) {          // Edit Brand
                e.preventDefault();
                var $this = $(this);
                var brand_id = $this.find('.brand_id').val();

                var route = '{{ route('brand.update',':brand_id') }}';
                route = route.replace(':brand_id', brand_id);

                $.ajax({
                    type: "POST",
                    url: route,
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if(response.success) {
                            window.location.reload();
                            localStorage.setItem("Status",response.message);
                        }
                    },
                    error: function (response) {
                        var error = response.responseJSON.error;
                        var title = $this.find('#modalEditBrandTitle');
                        title.addClass('is-invalid');
                        title.parent().find('.text-danger').removeClass('d-none');
                        title.parent().find('.text-danger').html(error);
                    },

                });

            });

            $('body').on('keypress', '#modalEditBrandTitle', function () {
                var $this = $(this);
                $this.hasClass('is-invalid') ? $this.removeClass('is-invalid') : '';
                $this.parent().find('.text-danger').addClass('d-none');
            });
            @endcan


            @can('brand.delete')
            $('body').on('click', '.delete_brand', function (e) {                   // Delete Vendor
                var $this = $(this);

                if (confirm('Are you sure you want to proceed?')) {
                } else {
                    return false;
                }

            });
            @endcan

        });

    </script>
@endsection
