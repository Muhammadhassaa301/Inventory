@extends('admin.layouts.master')
@section('title', 'Edit Product')
@section('content')

    <section id="basic-input">
        <div class="row">
            <form class="invoice-repeater" id="SubmitForm" action="{{ route('product.update', $product->id) }}" method="POST">
                @csrf
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Product</h4>
                        </div>
                        <div class="card-body">

                            @include('admin.partials.session_msgs')

                            <div class="mb-1">
                                <label class="form-label" for="title">Title</label>
                                <input type="text"
                                    class="form-control validation_field @error('title') is-invalid @enderror"
                                    placeholder="Enter Title" name="title" id="title"
                                    value="{{ old('title') ?? $product->title }}" aria-label="Title"
                                    aria-describedby="basic-addon1" />
                                @error('title')
                                    <div class="alert alert-danger error_validation">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-1">
                                <label class="form-label" for="basic-default-description">Description</label>
                                <textarea class="form-control" id="basic-default-description" rows="5" cols="5" name="description"
                                    placeholder="Description..." autocomplete="off">{{ $product->description }}</textarea>
                            </div>

                             
                             <label class="form-label" for="title">Asset Type</label>
                             <select id="asset_type" class=" form-select validation_field @error('type') is-invalid @enderror" name="asset_type">
                                <option value="">Asset Type</option>
                                <option value="fixed"      {{ old('asset_type', $product->asset_type) == 'fixed'      ? 'selected' : '' }}>Fixed</option>
                                <option value="consumable" {{ old('asset_type', $product->asset_type) == 'consumable' ? 'selected' : '' }}>Consumable</option>
                            </select>                           

                            <div class="mb-1">
                                <label class="form-label" for="product-brand">Brand</label>
                                <select id="product-brand"
                                    class=" form-select validation_field @error('brand') is-invalid @enderror"
                                    name="brand">
                                    <option value="">Select Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ $brand->id == old('brand', $product->brand_id) ? 'selected' : '' }}>
                                            {{ $brand->title }}</option>
                                    @endforeach
                                </select>
                                @error('brand')
                                    <div class="alert alert-danger error_validation">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Pricing</h4>
                        </div>
                        <div class="card-body">

                            <div class="mb-1">
                                 
                                <label class="form-label" for="product-type">Type</label>

                                <select id="product-type" class=" form-select validation_field @error('type') is-invalid @enderror" name="type">

                                    <option value="">Select Type</option>

                                    <option value="fixed" {{ old('type', $product->type) == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                    <option value="variable" {{ old('type', $product->type) == 'variable' ? 'selected' : '' }}>Variable</option>
                                </select>
                                @error('type')
                                    <div class="alert alert-danger error_validation">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-1 d-none" id="product-price">
                                <label class="form-label" for="price">Price</label>
                                <input type="number"
                                    class="form-control validation_field @error('price') is-invalid @enderror"
                                    placeholder="Enter Price" name="price" id="price" aria-label="Price"
                                    value="{{ old('price') ?? $product->price }}" aria-describedby="basic-addon1" />
                                @error('price')
                                    <div class="alert alert-danger error_validation">{{ $message }}</div>
                                @enderror
                            </div>


                            <div data-repeater-list="variation" class="d-none" id="price_variation">
                                @foreach ($variations as $key => $variation)
                                    <div data-repeater-item class="repeater-item">
                                        <input type="hidden" name="id" value="{{ $variation->id }}">

                                        <div class="row d-flex align-items-end">

                                            <div class="col-md-6 col-12 variation_details" id="product-variation">
                                                <div class="mb-1">
                                                    <label class="form-label" for="variation_title">Variation</label>
                                                    <input type="text"
                                                        class="form-control variation_title validation_field @error('variation.' . $key . '.title') is-invalid @enderror"
                                                        name="title"
                                                        value="{{ old('variation.' . $key . '.title') ?? $variation->title }}"
                                                        aria-describedby="itemvariation" placeholder="Enter Variation" />
                                                    @error('variation.' . $key . '.title')
                                                        <div class="alert alert-danger error_validation">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-2 col-12 variation_details">
                                                <div class="mb-1">
                                                    <label class="form-label" for="variation_price">Price</label>
                                                    <input type="number"
                                                        class="form-control variation_price validation_field @error('variation.' . $key . '.price') is-invalid @enderror"
                                                        name="price"
                                                        value="{{ old('variation.' . $key . '.price') ?? $variation->price }}"
                                                        aria-describedby="itemprice" placeholder="1000" />
                                                    @error('variation.' . $key . '.price')
                                                        <div class="alert alert-danger error_validation">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-2 col-12" id="delete_variation_btn">
                                                <div class="mb-1">
                                                    <button
                                                        class="btn btn-outline-danger text-nowrap px-1 delete_variation"
                                                        data-variation-id="{{ $variation->id }}" data-repeater-delete
                                                        type="button">
                                                        <i data-feather="x" class="me-25"></i>
                                                        <span>Delete</span>
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                        <hr />
                                    </div>
                                @endforeach

                                @php $old_variations = old('variation'); @endphp
                                @if ($old_variations)
                                    @foreach ($old_variations as $key => $old_variation)
                                        <div data-repeater-item>
                                            <div class="row d-flex align-items-end">
                                                <div class="col-md-4 col-12" id="product-variation">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="variation_title">Variation</label>
                                                        <input type="text"
                                                            class="form-control variation_title validation_field @error('variation.' . $key . '.title') is-invalid @enderror"
                                                            name="title" aria-describedby="itemvariation"
                                                            placeholder="Enter Variation"
                                                            value="{{ old('variation.' . $key . '.title') ?: '' }}" />
                                                        @error('variation.' . $key . '.title')
                                                            <div class="alert alert-danger error_validation">
                                                                {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="variation_price">Price</label>
                                                        <input type="number"
                                                            class="form-control variation_price validation_field @error('variation.' . $key . '.price') is-invalid @enderror"
                                                            name="price" aria-describedby="itemprice"
                                                            placeholder="1000"
                                                            value="{{ old('variation.' . $key . '.price') ?: '' }}" />
                                                        @error('variation.' . $key . '.price')
                                                            <div class="alert alert-danger error_validation">
                                                                {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            

                                                <div class="col-md-2 col-12">
                                                    <div class="mb-1">
                                                        <button
                                                            class="btn btn-outline-danger text-nowrap px-1 delete_variation"
                                                            data-repeater-delete type="button">
                                                            <i data-feather="x" class="me-25"></i>
                                                            <span>Delete</span>
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                            <hr />
                                        </div>
                                    @endforeach

                                @else

                                    <div data-repeater-item>
                                        <div class="row d-flex align-items-end">

                                            <div class="col-md-4 col-12" id="product-variation">
                                                <div class="mb-1">
                                                    <label class="form-label" for="variation_title">Variation</label>
                                                    <input type="text" class="form-control" id="variation_title"
                                                        name="title" aria-describedby="itemvariation"
                                                        placeholder="Enter Variation" />
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="variation_price">Price</label>
                                                    <input type="number" class="form-control" id="variation_price"
                                                        name="price" aria-describedby="itemprice" placeholder="1000" />
                                                </div>
                                            </div>

                                            <div class="col-md-2 col-12" id="delete_variation_btn">
                                                <div class="mb-1">
                                                    <button class="btn btn-outline-danger text-nowrap px-1"
                                                        data-repeater-delete type="button">
                                                        <i data-feather="x" class="me-25"></i>
                                                        <span>Delete</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                    </div>
                                @endif
                            </div>
                            <div class="row d-none" id="add_variation_btn">
                                <div class="col-12">
                                    <button class="btn btn-icon btn-primary float-end" type="button"
                                        data-repeater-create>
                                        <i data-feather="plus" class="me-25"></i>
                                        <span>Add New</span>
                                    </button>
                                </div>
                            </div>

                            <button style="margin-top: 65px !important;" class="btn btn-primary mt-3" type="submit"
                                id="save_btn">Save</button>
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
    {{--    <script src="{{ url('app-assets/js/scripts/pages/app-user-list.js?q='.time()) }}"></script> --}}
    <!-- END: Page JS-->

    {{-- </script> --}}




    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


var pri = $("#price").val();

            $('body').on('change', '#product-type', function() { // Change Product Type
                var $this = $(this);
                var type = $this.val();

                $this.hasClass('is-invalid') ? $this.removeClass('is-invalid') : '';
                $this.parent().find('.error_validation').addClass('d-none');

                if (type == 'fixed') {
                    $('#price_variation').addClass('d-none');
                    $('#product-price').removeClass('d-none');
                    $('#add_variation_btn').addClass('d-none');
                    $('#price').val(pri);
                } else if (type == 'variable') {
                    $('#price_variation').removeClass('d-none');
                    $('#add_variation_btn').removeClass('d-none');
                    $('#product-price').addClass('d-none');
                    $('#price').val('');
                } else {
                    $('#product-price').addClass('d-none');
                    $('#price_variation').addClass('d-none');
                    $('#add_variation_btn').addClass('d-none');
                    $('#price').val('');
                    $('#price').prop('required', false);
                    $('#variation_title').prop('required', false);
                    $('#variation_price').prop('required', false);
                }
            });

            $('body').on('keypress', '.validation_field', function() { // Error Validation
                var $this = $(this);
                $this.hasClass('is-invalid') ? $this.removeClass('is-invalid') : '';
                $this.parent().find('.error_validation').addClass('d-none');
            });

            $('body').on('change', '#product-brand', function() {
                var $this = $(this);
                $this.hasClass('is-invalid') ? $this.removeClass('is-invalid') : '';
                $this.parent().find('.error_validation').addClass('d-none');
            });


            $('.delete_variation').on('click', function() { // Delete Variation
                var $this = $(this);
                var variation_id = $this.data('variation-id');

                var route = '{{ route('product.variation.delete') }}';
                if (confirm('Are you sure you want to proceed?')) {

                    $.ajax({
                        type: "GET",
                        url: route,
                        data: {
                            variation_id: variation_id
                        },
                        success: function(response) {
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
                show: function() {
                    $(this).slideDown();
                    // Feather Icons
                    if (feather) {
                        feather.replace({
                            width: 14,
                            height: 14
                        });
                    }
                },
            });

        });



        

        $(window).on("load", function() {
                var selected_type = $("#product-type option:selected")
            .val(); // To get the selected Product Type
                if (selected_type == 'fixed') {
                    $('#product-price').removeClass('d-none');
                    $('#price_variation').addClass('d-none');
                    $('#add_variation_btn').addClass('d-none');
                    $('#variation_price').prop('required', false);
                    $('#variation_title').prop('required', false);
                    // $('#price').prop('required',true);
                } else if (selected_type == 'variable') {
                    $('#product-price').addClass('d-none');
                    $('#price_variation').removeClass('d-none');
                    $('#add_variation_btn').removeClass('d-none');
                    // $('#variation_price').prop('required',true);
                    // $('#variation_title').prop('required',true);
                    $('#price').val('');
                    $('#price').prop('required', false);
                }

                
            }); 


    </script>

@endsection
