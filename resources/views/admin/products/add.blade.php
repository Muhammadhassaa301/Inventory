@extends('admin.layouts.master')
@section('title', 'Add Product')
@section('content')

    <section id="basic-input">
        <div class="row">
            <form class="invoice-repeater" id="SubmitForm" action="{{ route('product.store') }}" method="POST">
                @csrf
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Product</h4>
                        </div>
                        <div class="card-body">
                            @include('admin.partials.session_msgs')

                            <div class="mb-1">
                                <label class="form-label" for="title">Title</label>
                                <input type="text"
                                    class="form-control validation_field @error('title') is-invalid @enderror"
                                    placeholder="Enter Title" name="title" id="title" value="{{ old('title') }}"
                                    aria-label="Title" aria-describedby="basic-addon1" required />
                                @error('title')
                                    <div class="alert alert-danger error_validation">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-1">
                                <label class="form-label" for="basic-default-description">Description</label>
                                <textarea class="form-control" rows="" cols="" name="description" id="basic-default-description"
                                    placeholder="Description..." autocomplete="off">{{ old('description') }}</textarea>
                            </div>

                            {{-- Wasim Qadir --}}
                            <label class="form-label" for="title">Asset Type</label>
                            <select class="form-select item-details select_product" name="asset_type">
                                <option selected disabled>Asset Type</option>
                                <option value="fixed">Fixed</option>
                                <option value="consumable">Consumable</option>                                
                            </select>

                            {{-- <div class="mb-1">
                                <label class="form-label" for="basic-default-description">Description</label>
                                <textarea class="form-control" rows="" cols="" name="description" id="basic-default-description"
                                    placeholder="Description..." autocomplete="off">{{ old('description') }}</textarea>
                            </div> --}}


                            <div class="mb-1">
                                <label class="form-label" for="product-brand">Brand</label>
                                <select id="product-brand"
                                    class=" form-select validation_field @error('brand') is-invalid @enderror"
                                    name="brand" required>
                                    <option value="">Select Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ $brand->id == old('brand') ? 'selected' : '' }}
                                            data-id="{{ $brand->id }}">{{ $brand->title }}</option>
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
                                <select id="product-type"
                                    class=" form-select validation_field @error('type') is-invalid @enderror" name="type"
                                    required>
                                    <option value="">Select Type</option>
                                    <option value="fixed" {{ 'fixed' == old('type') ? 'selected' : '' }}>Fixed</option>
                                    <option value="variable" {{ 'variable' == old('type') ? 'selected' : '' }}>Variable
                                    </option>
                                </select>
                                @error('type')
                                    <div class="alert alert-danger error_validation">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-1 d-none" id="product-price">
                                <label class="form-label" for="price">Price</label>
                                <input type="number"
                                    class="form-control validation_field @error('price') is-invalid @enderror"
                                    placeholder="Enter Price" name="price" id="price" value="{{ old('price') }}"
                                    aria-label="Price" aria-describedby="basic-addon1" />
                                @error('price')
                                    <div class="alert alert-danger error_validation">{{ $message }}</div>
                                @enderror
                            </div>


                            <div data-repeater-list="variation" class="d-none" id="price_variation">
                                @php $variations = old('variation'); @endphp
                                @if ($variations)
                                    @foreach ($variations as $key => $variation)
                                        <div data-repeater-item>
                                            <div class="row d-flex align-items-end">
                                                <div class="col-md-4 col-12" id="product-variation">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="variation_title">Variation</label>
                                                        <input type="text"
                                                            class="form-control validation_field @error('variation.' . $key . '.title') is-invalid @enderror"
                                                            id="variation_title" name="title"
                                                            aria-describedby="itemvariation" placeholder="Enter Variation"
                                                            value='{{ $variation['title'] ?? '' }}' />
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
                                                            class="form-control validation_field @error('variation.' . $key . '.price') is-invalid @enderror"
                                                            id="variation_price" name="price" aria-describedby="itemprice"
                                                            placeholder="1000" value='{{ $variation['price'] ?? '' }}' />
                                                        @error('variation.' . $key . '.price')
                                                            <div class="alert alert-danger error_validation">
                                                                {{ $message }}</div>
                                                        @enderror
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
                                    @endforeach
                                @else
                                    <div data-repeater-item>
                                        <div class="row d-flex align-items-end">

                                            <div class="col-md-4 col-12" id="product-variation">
                                                <div class="mb-1">
                                                    <label class="form-label" for="variation_title">Variation</label>
                                                    <input type="text"
                                                        class="form-control validation_field @error('variation') is-invalid @enderror"
                                                        id="variation_title" name="title"
                                                        aria-describedby="itemvariation" placeholder="Enter Variation"
                                                        value='{{ $variation['title'] ?? '' }}' />
                                                    @error('variation')
                                                        <div class="alert alert-danger error_validation">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="variation_price">Price</label>
                                                    <input type="number"
                                                        class="form-control validation_field @error('variation') is-invalid @enderror"
                                                        id="variation_price" name="price" aria-describedby="itemprice"
                                                        placeholder="1000" value='{{ $variation['price'] ?? '' }}' />
                                                    @error('variation')
                                                        <div class="alert alert-danger error_validation">{{ $message }}
                                                        </div>
                                                    @enderror
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
    {{--    <script src="{{ url('app-assets/js/scripts/pages/app-user-list.js?q='.time()) }}"></script> --}}
    <!-- END: Page JS-->

    {{-- </script> --}}




    <script>
        $(document).ready(function() {

            $(window).on("load", function() {
                var selected_type = $("#product-type option:selected").val();
                if (selected_type == 'fixed') {
                    $('#product-price').removeClass('d-none');
                    $('#price_variation').addClass('d-none');
                    $('#add_variation_btn').addClass('d-none');
                    $('#variation_price').prop('required', false);
                    $('#variation_title').prop('required', false);
                    $('#price').prop('required', true);
                } else if (selected_type == 'variable') {
                    $('#product-price').addClass('d-none');
                    $('#price_variation').removeClass('d-none');
                    $('#add_variation_btn').removeClass('d-none');
                    $('#variation_price').prop('required', true);
                    $('#variation_title').prop('required', true);
                    $('#price').val('');
                    $('#price').prop('required', false);
                }
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('change', '#product-type', function() {
                var $this = $(this);
                var type = $this.val();

                $this.hasClass('is-invalid') ? $this.removeClass('is-invalid') : '';
                $this.parent().find('.error_validation').addClass('d-none');

                if (type == 'fixed') {
                    $('#product-price').removeClass('d-none');
                    $('#price_variation').addClass('d-none');
                    $('#add_variation_btn').addClass('d-none');
                    $('#price').prop('required', true);
                    $('#variation_price').prop('required', false);
                    $('#variation_title').prop('required', false);

                } else if (type == 'variable') {
                    $('#product-price').addClass('d-none');
                    $('#price_variation').removeClass('d-none');
                    $('#add_variation_btn').removeClass('d-none');
                    $('#variation_price').prop('required', true);
                    $('#variation_title').prop('required', true);
                    $('#price').val('');
                    $('#price').prop('required', false);

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


            $('body').on('keypress', '.validation_field', function() {
                var $this = $(this);
                $this.hasClass('is-invalid') ? $this.removeClass('is-invalid') : '';
                $this.parent().find('.error_validation').addClass('d-none');
            });

            $('body').on('change', '#product-brand', function() {
                var $this = $(this);
                $this.hasClass('is-invalid') ? $this.removeClass('is-invalid') : '';
                $this.parent().find('.error_validation').addClass('d-none');
            });

        });
    </script>

@endsection
