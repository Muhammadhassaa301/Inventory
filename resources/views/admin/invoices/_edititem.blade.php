@extends('admin.layouts.master')
@section('title', 'Edit Product')
@section('content')

    <section id="basic-input">
        <div class="row">
            <form class="invoice-repeater" id="SubmitForm" action="{{ route('invoice.update', $productitems->id) }}"
                method="POST">
                @csrf
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Invoice Item</h4>
                        </div>
                        <div class="card-body">

                            @include('admin.partials.session_msgs')

                            <div class="mb-1">
                                <label class="form-label" for="title">Serial Number</label>
                                <input type="text"
                                    class="form-control validation_field @error('title') is-invalid @enderror"
                                    placeholder="Serial Number" name="serial_no" id="serial_no"
                                    value="{{ old('serial_no') ?? $productitems->serial_no }}" aria-label="Serial Number"
                                    aria-describedby="basic-addon1" />
                                @error('title')
                                    <div class="alert alert-danger error_validation">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-1">
                                <label class="form-label" for="title">Product Code</label>
                                <input type="text"
                                    class="form-control validation_field @error('title') is-invalid @enderror"
                                    placeholder="Product Code" name="product_code" id="product_code"
                                    value="{{ old('product_code') ?? $productitems->product_code }}"
                                    aria-label="Product Code" aria-describedby="basic-addon1" />
                                @error('title')
                                    <div class="alert alert-danger error_validation">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-1">
                                <label class="form-label" for="title">Products</label>
                                <select class="form-select item-details select_product" name="product">
                                    <option selected disabled>Select Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}"
                                            {{ $productitems->product_id == $product->id ? 'selected' : '' }}
                                            data-type="{{ $product->type }}"
                                            data-variation_id="{{ $productitems->variation_id }}"                                            
                                            data-isdefault= {{ $productitems->product_id == $product->id ? 'YES' : 'NO' }}
                                            >
                                            {{ $product->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @if ($pro->type == 'variable')
                                <div class="mb-1 product_div ">
                                    <div class="variation_div">
                                        <label class="form-label" for="title">Variation</label>
                                        <select class="form-select item-details select_variation" name="variation">

                                            @foreach ($pro->variations as $variation)
                                                <option value="{{ $variation->id }}" 
                                                    data-price="{{$variation->price}}"
                                                    {{ $variation->id == $productitems->variation_id ? 'selected' : '' }}>
                                                    {{$variation->title}}
                                                </option>


                                                    {{-- {{ $productitems->product_id == $pvariatoin->id ? 'selected' : '' }} --}}
                                                    {{-- data-type="{{ $product->type }}"> --}}
                                                    {{-- {{ $variation->title }}
                                                </option> --}}
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                </div>
                            @endif

                            <div class="mb-1">
                                <label class="form-label" for="title">Price</label>
                                <input type="text"
                                    class="form-control product_price validation_field @error('title') is-invalid @enderror"
                                    placeholder="Product Code" name="price" id="price"
                                    value="{{ old('price') ?? $productitems->price }}"
                                    
                                    aria-label="Price" aria-describedby="basic-addon1" />
                                @error('title')
                                    <div class="alert alert-danger error_validation">{{ $message }}</div>
                                @enderror
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
            // $(window).on("load", function() {
            //     var $this = $(this);
            //     var selected_type = $("#product-type option:selected")
            //         .val(); // To get the selected Product Type

            //     if (selected_type == 'fixed') {
            //         console.log("Loading, Type = fixed, removing");
            //         $this.parent().closest('.card-body').find('.variation_div').addClass('d-none');
            //     } else if (selected_type == 'variable') {
            //         console.log("Loading, Type = Variable");
            //         $this.parent().closest('.card-body').find('.variation_div').removeClass('d-none');
            //     }
            // });

            $('body').on('change', '.select_variation', function() {
                var $this = $(this);
                var price = $("option:selected", $this).data('price');
              
                $this.parent().closest('.card-body').find('.product_price').val(price);
                console.log('Price_Vr: ' + price);
            });

            $('body').on('change', '.select_product', function() {
                var $this = $(this);
                var product_id = $this.val();
                var type = $("option:selected", $this).data('type');
                var variation_id = $("option:selected", $this).data('variation_id');
                var isdefault  = $("option:selected", $this).data('isdefault');
                var product_price = $this.parent().closest('.card-body').find('.product_price').val();

                if (type == 'fixed') {                   
                    $this.parent().closest('.card-body').find('.variation_div').addClass('d-none');

                } else {                
                    $this.parent().closest('.card-body').find('.variation_div').removeClass('d-none');                   
                }

                var route = '{{ route('invoice.get.product.price') }}';                

                $.ajax({
                    type: "GET",
                    url: route,
                    data: {
                        product_id: product_id
                    },
                    success: function(response) {
                        if (response.success) {

                            if (response.type == 'variable') {
                                var variation_html = "";

                                $.each(response.variations, function(k, v) {
                                    var id = v.id;
                                    var title = v.title;
                                    var price = v.price;
                                    var selectitem = "";

                                    if(isdefault == "YES" && variation_id == v.id) 
                                    {                                     
                                        selectitem = " selected ";
                                    }
                                  
                                     variation_html += "<option value='" + id + "'" +
                                     "data-price='" + price +" '" + 
                                     selectitem + " >" + 
                                     title + "" +
                                         "</option>";
                                });
                              
                                $this.parent().closest('.card-body').find('.select_variation').html(variation_html);

                                var tmp = $(".select_variation option:selected").data('price');

                                //console.log('Price_ProdChangeV: ' + tmp);
                                $this.parent().closest('.card-body').find('.product_price').val(tmp);
                            }
                            else // response.type == 'fixed'
                            {
                                //console.log('Price_ProdChangeF: ' + response.price);

                                $this.parent().closest('.card-body').find('.product_price').val(response.price);
                            }
                        }
                    }
                });
            });

        });
    </script>

@endsection
