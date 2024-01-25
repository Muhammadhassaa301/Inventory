@extends('admin.layouts.master')
@section('title','Add Product')
@section('content')

    <section id="basic-input">
        <div class="row">
            <form class="invoice-repeater" id="SubmitForm" action="{{ route('students.store') }}" method="POST">
                @csrf
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Student</h4>
                        </div>
                        <div class="card-body">

                            @include('admin.partials.session_msgs')

                            <div class="mb-1">
                                <label class="form-label" for="title">Title</label>
                                <input type="text" class="form-control validation_field @error('title') is-invalid @enderror"
                                       placeholder="Enter Title" name="FirstName" id="title" value="{{ old('title') }}" aria-label="Title"
                                       aria-describedby="basic-addon1" required/>
                                @error('title')
                                <div class="alert alert-danger error_validation">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-1">
                                <label class="form-label" for="basic-default-description">Description</label>
                                <textarea class="form-control" rows="" cols="" name="LastName" id="basic-default-description"
                                          placeholder="Description..." autocomplete="off">{{ old('description') }}</textarea>
                            </div>


                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Student</h4>
                        </div>
                        <div class="card-body">
                            <button style="margin-top: 65px !important;" class="btn btn-primary mt-3" type="submit" id="save_btn">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

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
    <script src="{{ url('app-assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ url('app-assets/js/scripts/forms/form-repeater.js') }}"></script>

    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ url('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ url('app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    {{--    <script src="{{ url('app-assets/js/scripts/pages/app-user-list.js?q='.time()) }}"></script>--}}
    <!-- END: Page JS-->

    {{-- </script> --}}




    <script>
        $(document).ready(function () {

            $( window ).on( "load", function() {
                var selected_type = $("#product-type option:selected").val();
                if(selected_type == 'fixed') {
                    $('#product-price').removeClass('d-none');
                    $('#price_variation').addClass('d-none');
                    $('#add_variation_btn').addClass('d-none');
                    $('#variation_price').prop('required',false);
                    $('#variation_title').prop('required',false);
                    $('#price').prop('required',true);
                } else if(selected_type == 'variable') {
                    $('#product-price').addClass('d-none');
                    $('#price_variation').removeClass('d-none');
                    $('#add_variation_btn').removeClass('d-none');
                    $('#variation_price').prop('required',true);
                    $('#variation_title').prop('required',true);
                    $('#price').val('');
                    $('#price').prop('required',false);
                }
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('change', '#product-type', function () {
               var $this = $(this);
               var type = $this.val();

                $this.hasClass('is-invalid') ? $this.removeClass('is-invalid') : '';
                $this.parent().find('.error_validation').addClass('d-none');

               if(type == 'fixed') {
                   $('#product-price').removeClass('d-none');
                   $('#price_variation').addClass('d-none');
                   $('#add_variation_btn').addClass('d-none');
                   $('#price').prop('required',true);
                   $('#variation_price').prop('required',false);
                   $('#variation_title').prop('required',false);

               } else if (type == 'variable'){
                   $('#product-price').addClass('d-none');
                   $('#price_variation').removeClass('d-none');
                   $('#add_variation_btn').removeClass('d-none');
                   $('#variation_price').prop('required',true);
                   $('#variation_title').prop('required',true);
                   $('#price').val('');
                   $('#price').prop('required',false);

               } else {
                   $('#product-price').addClass('d-none');
                   $('#price_variation').addClass('d-none');
                   $('#add_variation_btn').addClass('d-none');
                   $('#price').val('');
                   $('#price').prop('required',false);
                   $('#variation_title').prop('required',false);
                   $('#variation_price').prop('required',false);
               }

            });


            $('body').on('keypress', '.validation_field', function () {
                var $this = $(this);
                $this.hasClass('is-invalid') ? $this.removeClass('is-invalid') : '';
                $this.parent().find('.error_validation').addClass('d-none');
            });

            $('body').on('change', '#product-brand', function () {
               var $this = $(this);
                $this.hasClass('is-invalid') ? $this.removeClass('is-invalid') : '';
                $this.parent().find('.error_validation').addClass('d-none');
            });

        });

    </script>

@endsection
