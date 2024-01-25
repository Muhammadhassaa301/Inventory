@extends('admin.layouts.master')
@section('title','Edit Student')
@section('content')

    <section id="basic-input">
        <div class="row">
            <form class="invoice-repeater" id="SubmitForm" action="{{ route('students.update', $stu->id) }}" method="POST">
                @csrf
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Product</h4>
                    </div>
                    <div class="card-body">

                        @include('admin.partials.session_msgs')

                            <div class="mb-1">
                                <label class="form-label" for="title">First Name</label>
                                <input type="text" class="form-control validation_field @error('title') is-invalid @enderror" placeholder="Enter Title" name="FirstName"
                                       id="FirstName" value="{{old('title') ?? $stu->FirstName }}" aria-label="Title" aria-describedby="basic-addon1" />
                                @error('title')<div class="alert alert-danger error_validation">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-1">
                                <label class="form-label" for="basic-default-description">Last Name</label>
                                <textarea class="form-control" id="LastName" rows="5" cols="5" name="LastName" placeholder="Description..." autocomplete="off">{{ $stu->LastName }}</textarea>
                          
                                <button style="margin-top: 65px !important;" class="btn btn-primary mt-3" type="submit" id="save_btn">Save</button>

                            </div>
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
        $(document).ready(function (){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

{{--            @if($product->type == 'variable')--}}
{{--                $('#price_variation').removeClass('d-none');--}}
{{--                $('#add_variation_btn').removeClass('d-none');--}}
{{--                @elseif($product->type == 'fixed')--}}
{{--                 $('#product-price').removeClass('d-none');--}}
{{--                 @else--}}
                 // $('#price_variation').addClass('d-none');
                 // $('#add_variation_btn').addClass('d-none');
                 // $('#product-price').addClass('d-none');
{{--            @endif--}}

        $( window ).on( "load", function() {
            var selected_type = $("#product-type option:selected").val();       // To get the selected Product Type
            if(selected_type == 'fixed') {
                $('#product-price').removeClass('d-none');
                $('#price_variation').addClass('d-none');
                $('#add_variation_btn').addClass('d-none');
                $('#variation_price').prop('required',false);
                $('#variation_title').prop('required',false);
                // $('#price').prop('required',true);
            } else if(selected_type == 'variable') {
                $('#product-price').addClass('d-none');
                $('#price_variation').removeClass('d-none');
                $('#add_variation_btn').removeClass('d-none');
                // $('#variation_price').prop('required',true);
                // $('#variation_title').prop('required',true);
                $('#price').val('');
                $('#price').prop('required',false);
            }
        });


            $('body').on('change', '#product-type', function () {               // Change Product Type
               var $this = $(this);
               var type = $this.val();

                $this.hasClass('is-invalid') ? $this.removeClass('is-invalid') : '';
                $this.parent().find('.error_validation').addClass('d-none');

               if(type == 'fixed') {
                   $('#price_variation').addClass('d-none');
                   $('#product-price').removeClass('d-none');
                   $('#add_variation_btn').addClass('d-none');
               } else if(type == 'variable') {
                   $('#price_variation').removeClass('d-none');
                   $('#add_variation_btn').removeClass('d-none');
                   $('#product-price').addClass('d-none');
                   $('#price').val('');
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

            $('body').on('keypress', '.validation_field', function () {         // Error Validation
                var $this = $(this);
                $this.hasClass('is-invalid') ? $this.removeClass('is-invalid') : '';
                $this.parent().find('.error_validation').addClass('d-none');
            });

            $('body').on('change', '#product-brand', function () {
                var $this = $(this);
                $this.hasClass('is-invalid') ? $this.removeClass('is-invalid') : '';
                $this.parent().find('.error_validation').addClass('d-none');
            });


            $('.delete_variation').on('click', function () {                // Delete Variation
                var $this = $(this);
                var variation_id = $this.data('variation-id');

                var route = '{{ route('product.variation.delete') }}';
                if (confirm('Are you sure you want to proceed?')) {

                    $.ajax({
                        type: "GET",
                        url: route,
                        data: {variation_id: variation_id},
                        success: function (response) {
                            if (response.success) {
                                $this.closest('.repeater-item').remove();
                            }
                        }
                    });
                } else {
                    return false;
                }
            });


            // Form Repeater jQuery

            $('.invoice-repeater, .repeater-default').repeater({
                show: function () {
                    $(this).slideDown();
                    // Feather Icons
                    if (feather) {
                        feather.replace({ width: 14, height: 14 });
                    }
                },
            });

        });

    </script>

@endsection
