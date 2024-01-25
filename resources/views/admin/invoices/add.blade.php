@extends('admin.layouts.master')
@section('title', 'Add Invoice')
@section('content')

    <!-- BEGIN: Content-->
    @can('invoice.add')
        {{--        <div class="content-body"> --}}
        @include('admin.partials.session_msgs')

        <section class="invoice-add-wrapper">
            <form method="post" action="{{ route('invoice.store') }}">
                @csrf
                <div class="row invoice-add">
                    <!-- Invoice Add Left starts -->
                    <div class="col-xl-9 col-md-8 col-12">
                        <div class="card invoice-preview-card">
                            <!-- Header starts -->
                            <div class="card-body invoice-padding pb-0">
                                <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                    <div>
                                        <div class="logo-wrapper">
                                            <svg viewBox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                                <defs>
                                                    <linearGradient id="invoice-linearGradient-1" x1="100%"
                                                        y1="10.5120544%" x2="50%" y2="89.4879456%">
                                                        <stop stop-color="#000000" offset="0%"></stop>
                                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                                    </linearGradient>
                                                    <linearGradient id="invoice-linearGradient-2" x1="64.0437835%"
                                                        y1="46.3276743%" x2="37.373316%" y2="100%">
                                                        <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                                    </linearGradient>
                                                </defs>
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <g transform="translate(-400.000000, -178.000000)">
                                                        <g transform="translate(400.000000, 178.000000)">
                                                            <path class="text-primary"
                                                                d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"
                                                                style="fill: currentColor"></path>
                                                            <path
                                                                d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"
                                                                fill="url(#invoice-linearGradient-1)" opacity="0.2"></path>
                                                            <polygon fill="#000000" opacity="0.049999997"
                                                                points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325">
                                                            </polygon>
                                                            <polygon fill="#000000" opacity="0.099999994"
                                                                points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338">
                                                            </polygon>
                                                            <polygon fill="url(#invoice-linearGradient-2)" opacity="0.099999994"
                                                                points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288">
                                                            </polygon>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                            <h3 class="text-primary invoice-logo">Vuexy</h3>
                                        </div>
                                        {{--                                        <p class="card-text mb-25">Office 149, 450 South Brand Brooklyn</p> --}}
                                        {{--                                        <p class="card-text mb-25">San Diego County, CA 91905, USA</p> --}}
                                        {{--                                        <p class="card-text mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p> --}}
                                    </div>
                                    <div class="invoice-number-date mt-md-0 mt-2">
                                        <div class="d-flex align-items-center justify-content-md-end mb-1">
                                            <h4 class="invoice-title">Invoice</h4>
                                            <div class="input-group input-group-merge invoice-edit-input-group">
                                                <div class="input-group-text">
                                                    <i data-feather="hash"></i>
                                                </div>
                                                <input type="text" class="form-control invoice-edit-input"
                                                    placeholder="53634" name="invoice_no" />
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-1">
                                            <span class="title">Date:</span>
                                            <input type="date" class="form-control invoice-edit-input date-picker"
                                                name="date" />
                                        </div>
                                        {{--    <div class="d-flex align-items-center"> --}}
                                        {{--   <span class="title">Due Date:</span> --}}
                                        {{--    <input type="text" class="form-control invoice-edit-input due-date-picker" /> --}}
                                        {{--  </div> --}}
                                    </div>
                                </div>
                            </div>
                            <!-- Header ends -->

                            <hr class="invoice-spacing" />

                            <!-- Address and Contact starts -->
                            <div class="card-body invoice-padding pt-0">
                                <div class="row row-bill-to invoice-spacing">
                                    <div class="col-xl-8 mb-lg-1 col-bill-to ps-0">
                                        <h6 class="invoice-to-title">Vendors</h6>
                                        <div class="invoice-customer">
                                            <select class="invoiceto form-select" name="vendor">
                                                <option></option>
                                                @foreach ($vendors as $vendor)
                                                    <option value="{{ $vendor->id }}">{{ $vendor->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{--  <div class="col-xl-4 p-0 ps-xl-2 mt-xl-0 mt-2"> --}}
                                    {{--   <h6 class="mb-2">Payment Details:</h6> --}}
                                    {{--   <table> --}}
                                    {{--       <tbody> --}}
                                    {{--       <tr> --}}
                                    {{--           <td class="pe-1">Total Due:</td> --}}
                                    {{--           <td><strong>$12,110.55</strong></td> --}}
                                    {{--       </tr> --}}
                                    {{--       <tr> --}}
                                    {{--           <td class="pe-1">Bank name:</td> --}}
                                    {{--           <td>American Bank</td> --}}
                                    {{--       </tr> --}}
                                    {{--       <tr> --}}
                                    {{--           <td class="pe-1">Country:</td> --}}
                                    {{--           <td>United States</td> --}}
                                    {{--       </tr> --}}
                                    {{--       <tr> --}}
                                    {{--           <td class="pe-1">IBAN:</td> --}}
                                    {{--           <td>ETD95476213874685</td> --}}
                                    {{--       </tr> --}}
                                    {{--       <tr> --}}
                                    {{--           <td class="pe-1">SWIFT code:</td> --}}
                                    {{--           <td>BR91905</td> --}}
                                    {{--       </tr> --}}
                                    {{--       </tbody> --}}
                                    {{--   </table> --}}
                                    {{--  </div> --}}

                                </div>
                            </div>
                            <!-- Address and Contact ends -->

                            <!-- Product Details starts -->
                            <div class="card-body invoice-padding invoice-product-details">
                                <div class="source-item">
                                    <div data-repeater-list="items">
                                        <div class="repeater-wrapper" data-repeater-item>
                                            <div class="row">
                                                <div class="col-12 d-flex product-details-border position-relative pe-0">
                                                    <div class="row w-100 pe-lg-0 pe-1 py-2 product_div">
                                                        <div class="col-lg-5 col-12 mb-lg-0 mb-2 mt-lg-0 mt-2">
                                                            <p class="card-text col-title mb-md-50 mb-0">Products</p>
                                                            <select class="form-select item-details select_product"
                                                                name="product">
                                                                <option selected disabled>Select Product</option>
                                                                @foreach ($products as $product)
                                                                    <option value="{{ $product->id }}"
                                                                        data-type="{{ $product->type }}">{{ $product->title }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <textarea class="form-control mt-2 d-none" rows="1">Customization & Bug Fixes</textarea>
                                                        </div>
                                                        <div class="col-lg-3 col-12 mb-lg-0 mb-2 mt-lg-0 mt-2 variation_div d-none"
                                                            data-product-id="{{ $product->id }}">
                                                            <p class="card-text col-title mb-md-50 mb-0">Variations</p>
                                                            <select class="form-select item-details select_variation"
                                                                name="variation"></select>
                                                            <textarea class="form-control mt-2 d-none" rows="1">Customization & Bug Fixes</textarea>
                                                        </div>

                                                        {{-- <div class="col-lg-3 col-12 mb-lg-0 mb-2 mt-lg-0 mt-2 select_variation d-none" data-product-id="{{ $product->id }}"> --}}
                                                        {{--      <p class="card-text col-title mb-md-50 mb-0">Variations</p> --}}
                                                        {{--      <select class="form-select item-details" name="variation"> --}}
                                                        {{--          <option selected disabled>Select Variation</option> --}}
                                                        {{--          @foreach ($product->variations as $variation) --}}
                                                        {{--              <option value="{{ $variation->id }}">{{ $variation->title }}</option> --}}
                                                        {{--          @endforeach --}}
                                                        {{--      </select> --}}
                                                        {{--      <textarea class="form-control mt-2 d-none" rows="1">Customization & Bug Fixes</textarea> --}}
                                                        {{--  </div> --}}
                                                        {{--  <div class="col-lg-3 col-12 my-lg-0 my-2"> --}}
                                                        {{--      <p class="card-text col-title mb-md-2 mb-0">Cost</p> --}}
                                                        {{--      <input type="text" class="form-control" value="24" placeholder="24" /> --}}
                                                        {{--      <div class="mt-2"> --}}
                                                        {{--          <span>Discount:</span> --}}
                                                        {{--          <span class="discount">0%</span> --}}
                                                        {{--          <span class="tax-1 ms-50" data-bs-toggle="tooltip" data-bs-placement="top" title="Tax 1">0%</span> --}}
                                                        {{--          <span class="tax-2 ms-50" data-bs-toggle="tooltip" data-bs-placement="top" title="Tax 2">0%</span> --}}
                                                        {{--      </div> --}}
                                                        {{--  </div> --}}


                                                        <div class="col-lg-2 col-12 my-lg-0 my-2">
                                                            <p class="card-text col-title mb-md-2 mb-0">Qty</p>
                                                            <input type="number" class="form-control product_QTY"
                                                                value="1" placeholder="1" name="quantity" />
                                                        </div>

                                                        {{-- WQ-ADD --}}
                                                        <div class="col-lg-2 col-12 my-lg-0 my-2">
                                                            <p class="card-text col-title mb-md-2 mb-0">Price</p>
                                                            <input type="number" class="form-control product_price"
                                                                value="1" placeholder="1" name="product_price"
                                                                data-rate />
                                                        </div>

                                                        {{-- <div class="col-lg-2 col-12 mt-lg-0 mt-2">
                                                        <p class="card-text col-title mb-md-50 mb-0">Price</p>
                                                        <p class="card-text mb-0 product_price" id="product_price">$0.00</p>
                                                    </div> --}}

                                                    </div>
                                                    <div
                                                        class="
                        d-flex
                        flex-column
                        align-items-center
                        justify-content-between
                        border-start
                        WQinvoice-product-actions
                        py-50
                        px-25
                      ">
                                                        <i data-feather="x" class="cursor-pointer font-medium-3"
                                                            data-repeater-delete></i>

                                                        {{--    <div class="dropdown"> --}}
                                                        {{--      <i class="cursor-pointer more-options-dropdown me-0" data-feather="settings" id="dropdownMenuButton" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> --}}
                                                        {{--      </i> --}}
                                                        {{--      <div class="dropdown-menu dropdown-menu-end item-options-menu p-50" aria-labelledby="dropdownMenuButton"> --}}
                                                        {{--          <div class="mb-1"> --}}
                                                        {{--              <label for="discount-input" class="form-label">Discount(%)</label> --}}
                                                        {{--              <input type="number" class="form-control" id="discount-input" /> --}}
                                                        {{--          </div> --}}
                                                        {{--          <div class="form-row mt-50"> --}}
                                                        {{--              <div class="mb-1 col-md-6"> --}}
                                                        {{--                  <label for="tax-1-input" class="form-label">Tax 1</label> --}}
                                                        {{--                  <select name="tax-1-input" id="tax-1-input" class="form-select tax-select"> --}}
                                                        {{--                      <option value="0%" selected>0%</option> --}}
                                                        {{--                      <option value="1%">1%</option> --}}
                                                        {{--                      <option value="10%">10%</option> --}}
                                                        {{--                      <option value="18%">18%</option> --}}
                                                        {{--                      <option value="40%">40%</option> --}}
                                                        {{--                  </select> --}}
                                                        {{--              </div> --}}
                                                        {{--              <div class="mb-1 col-md-6"> --}}
                                                        {{--                  <label for="tax-2-input" class="form-label">Tax 2</label> --}}
                                                        {{--                  <select name="tax-2-input" id="tax-2-input" class="form-select tax-select"> --}}
                                                        {{--                      <option value="0%" selected>0%</option> --}}
                                                        {{--                      <option value="1%">1%</option> --}}
                                                        {{--                      <option value="10%">10%</option> --}}
                                                        {{--                      <option value="18%">18%</option> --}}
                                                        {{--                      <option value="40%">40%</option> --}}
                                                        {{--                  </select> --}}
                                                        {{--              </div> --}}
                                                        {{--          </div> --}}
                                                        {{--          <div class="dropdown-divider my-1"></div> --}}
                                                        {{--          <div class="d-flex justify-content-between"> --}}
                                                        {{--              <button type="button" class="btn btn-outline-primary btn-apply-changes">Apply</button> --}}
                                                        {{--              <button type="button" class="btn btn-outline-secondary">Cancel</button> --}}
                                                        {{--          </div> --}}
                                                        {{--      </div> --}}
                                                        {{--  </div> --}}

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-12 px-0">
                                            <button type="button" class="btn btn-primary btn-sm btn-add-new"
                                                data-repeater-create>
                                                <i data-feather="plus" class="me-25"></i>
                                                <span class="align-middle">Add Item</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Product Details ends -->

                            <!-- Invoice Total starts -->
                            <div class="card-body invoice-padding">
                                <div class="row invoice-sales-total-wrapper">
                                    <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                        {{-- <div class="d-flex align-items-center mb-1">
                                            <label for="salesperson" class="form-label">Salesperson:</label>
                                            <input type="text" class="form-control ms-50" id="salesperson" placeholder="Edward Crowley" />
                                        </div> --}}
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                        <div class="invoice-total-wrapper">
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">Subtotal:</p>
                                                <p class="invoice-total-amount wqSubTotal">PKR 0</p>
                                            </div>
                                            {{-- <div class="invoice-total-item">
                                                <p class="invoice-total-title">Discount:</p>
                                                <p class="invoice-total-amount">$28</p>
                                            </div> --}}
                                            {{-- <div class="invoice-total-item">
                                                <p class="invoice-total-title">Tax:</p>
                                                <p class="invoice-total-amount">21%</p>
                                            </div> --}}
                                            {{-- <hr class="my-50" /> --}}
                                            {{-- <div class="invoice-total-item">
                                                <p class="invoice-total-title">Total:</p>
                                                <p class="invoice-total-amount">$1690</p>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Invoice Total ends -->

                            <hr class="invoice-spacing mt-0" />

                            <div class="card-body invoice-padding py-0">
                                <!-- Invoice Note starts -->
                                <div class="row">
                                    <div class="col-12">
                                        {{-- <div class="mb-2">
                                            <label for="note" class="form-label fw-bold">Note:</label>
                                            <textarea class="form-control" rows="2" id="note">
It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance projects. Thank You!</textarea>
                                        </div> --}}

                                    </div>
                                </div>
                                <!-- Invoice Note ends -->
                            </div>
                        </div>
                    </div>
                    <!-- Invoice Add Left ends -->

                    <!-- Invoice Add Right starts -->
                    <div class="col-xl-3 col-md-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <button type="submit" class="btn btn-outline-primary w-100">Save</button>
                            </div>
                        </div>
                        {{-- <div class="mt-2">
                            <p class="mb-50">Accept payments via</p>
                            <select class="form-select">
                                <option value="Bank Account">Bank Account</option>
                                <option value="Paypal">Paypal</option>
                                <option value="UPI Transfer">UPI Transfer</option>
                            </select>
                            <div class="invoice-terms mt-1">
                                <div class="d-flex justify-content-between">
                                    <label class="invoice-terms-title mb-0" for="paymentTerms">Payment Terms</label>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" checked id="paymentTerms" />
                                        <label class="form-check-label" for="paymentTerms"></label>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between py-1">
                                    <label class="invoice-terms-title mb-0" for="clientNotes">Client Notes</label>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" checked id="clientNotes" />
                                        <label class="form-check-label" for="clientNotes"></label>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <label class="invoice-terms-title mb-0" for="paymentStub">Payment Stub</label>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" id="paymentStub" />
                                        <label class="form-check-label" for="paymentStub"></label>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <!-- Invoice Add Right ends -->
                </div>
            </form>

            <!-- Add New Customer Sidebar -->
            <div class="modal modal-slide-in fade" id="add-new-customer-sidebar" aria-hidden="true">
                <div class="modal-dialog sidebar-lg">
                    <div class="modal-content p-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                        <div class="modal-header mb-1">
                            <h5 class="modal-title">
                                <span class="align-middle">Add Customer</span>
                            </h5>
                        </div>
                        <div class="modal-body flex-grow-1">
                            <form>
                                <div class="mb-1">
                                    <label for="customer-name" class="form-label">Customer Name</label>
                                    <input type="text" class="form-control" id="customer-name" placeholder="John Doe" />
                                </div>
                                <div class="mb-1">
                                    <label for="customer-email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="customer-email"
                                        placeholder="example@domain.com" />
                                </div>
                                <div class="mb-1">
                                    <label for="customer-address" class="form-label">Customer Address</label>
                                    <textarea class="form-control" id="customer-address" cols="2" rows="2"
                                        placeholder="1307 Lady Bug Drive New York"></textarea>
                                </div>
                                <div class="mb-1 position-relative">
                                    <label for="customer-country" class="form-label">Country</label>
                                    <select class="form-select" id="customer-country" name="customer-country">
                                        <option label="select country"></option>
                                        <option value="Australia">Australia</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Russia">Russia</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United States of America">United States of America</option>
                                    </select>
                                </div>
                                <div class="mb-1">
                                    <label for="customer-contact" class="form-label">Contact</label>
                                    <input type="number" class="form-control" id="customer-contact"
                                        placeholder="763-242-9206" />
                                </div>
                                <div class="mb-1 d-flex flex-wrap mt-2">
                                    <button type="button" class="btn btn-primary me-1" data-bs-dismiss="modal">Add</button>
                                    <button type="button" class="btn btn-outline-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add New Customer Sidebar -->
        </section>

        {{--        </div> --}}
    @endcan

    {{--    @include('admin.vendors.modals.add') --}}

@endsection

@section('scripts')

    <!-- BEGIN: Vendor JS-->
    <script src="{{ url('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ url('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    {{--    <script src="{{ url('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script> --}}
    {{--    <script src="{{ url('app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script> --}}
    {{--    <script src="{{ url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script> --}}
    {{--    <script src="{{ url('app-assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script> --}}
    {{--    <script src="{{ url('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script> --}}
    {{--    <script src="{{ url('app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script> --}}
    {{--    <script src="{{ url('app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script> --}}
    {{--    <script src="{{ url('app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script> --}}
    {{--    <script src="{{ url('app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script> --}}
    {{--    <script src="{{ url('app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script> --}}
    {{--    <script src="{{ url('app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script> --}}
    <script src="{{ url('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/forms/cleave/cleave.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/forms/cleave/addons/cleave-phone.us.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ url('app-assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    {{-- <script src="{{ url('app-assets/js/scripts/forms/form-repeater.js') }}"></script> --}}

    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ url('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ url('app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    {{-- <script src="{{ url('app-assets/js/scripts/pages/app-invoice.js') }}"></script>
    <!-- END: Page JS--> --}}
    <script>
        //   $('.invoice-repeater, .repeater-default, .source-item').repeater({
        //     show: function () {
        //         console.log("wqAdding");
        //       $(this).slideDown();
        //       // Feather Icons
        //       if (feather) {
        //         feather.replace({ width: 14, height: 14 });
        //       }

        //     },

        //   });


        // form repeater jquery
        $('.invoice-repeater, .repeater-default , .source-item').repeater({
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
            hide: function(deleteElement) {
                var cnt = $('.repeater-wrapper').length;

                console.log("Deleting-..., Cnt: " + cnt);

                if (cnt < 2) {
                    IsDeleted = false;
                    alert("Can not delete.");
                } else {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                        IsDeleted = true;

                        setTimeout(() => {
                            CalcTotal();
                        }, 500);

                    } else {
                        IsDeleted = false;
                    }
                }
            }
        });

        // ==============================================================================
        var IsDeleted = false;

        function CalcTotal() {
            var v = 0;
            var tot = 0;

            $('.product_div').each(function() {
                var $this = $(this);
                v = v + 1;

                //var product_price = $this.parent().closest('.product_div').find('.product_price');

                var ProdQty = $this.find('.product_QTY').val();
                var ProdPrice = $this.find('.product_price').val();

                //var price_v = $("option:selected", $this).data('price');

                // var t = $this.parent().closest('.product_div').find('.select_product');

                // console.log('PriceV: ' + t);

                if (ProdQty) {
                    //console.log("Qty value: " + ProdQty);
                    //console.log("Price: " + ProdPrice);                    
                    tot = tot + (ProdQty * ProdPrice);
                }
            });

            var r = NumWithComma(tot);

            $('.wqSubTotal').text("PKR " + r);

            return tot;
        }

        function NumWithComma(value) {
            return value.toLocaleString(undefined, {
                maximumFractionDigits: 2
            });
        }

        $(document).ready(function() {
            $(window).on('load', function() {
                if (feather) {
                    feather.replace({
                        width: 14,
                        height: 14
                    });
                }
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('input', '.product_QTY', function() {
                var $this = $(this);
                var PQ = $this.val();

                var PrRate = $this.parent().closest('.product_div').find('.product_price');

                console.log('Org Rate: ' + PrRate.attr('data-rate'));
                //$this['prod_rate'] = 55;

                //console.log("PR: " + PR + ", Qty: " + PQ);
                CalcTotal();
            });

            $('body').on('change', '.select_variation', function() {
                var $this = $(this);
                var price = $("option:selected", $this).data('price');
                //console.log(price);

                $this.parent().closest('.product_div').find('.product_price').val(price);

                var Qv = $this.parent().closest('.product_div').find('.product_QTY').val();
                var t = $("option:selected", $this).val();

                //console.log('Price_Vr: ' + price + '; Qty: ' + Qv + '; ' + t.trim());

                CalcTotal();
            });

            $('body').on('change', '.select_product', function() {
                var $this = $(this);
                var product_id = $this.val();
                var type = $("option:selected", $this).data('type');

                // var Qf = $this.parent().closest('.product_div').find('.product_QTY').val();
                // console.log(Qf);    

                if (type == 'fixed') {
                    //console.log("Type = fixed, removing");
                    $this.parent().closest('.product_div').find('.variation_div').addClass('d-none');
                    // setTimeout(() => {
                    //         CalcTotal();
                    // }, 500);
                    //CalcTotal();                 
                } else {
                    //console.log("Type = Variable");
                    $this.parent().closest('.product_div').find('.variation_div').removeClass('d-none');

                    // setTimeout(() => {
                    //         CalcTotal();
                    // }, 500);
                    //CalcTotal();
                }

                var product_price = $this.parent().closest('.product_div').find('.product_price');
                var route = '{{ route('invoice.get.product.price') }}';

                $.ajax({
                    type: "GET",
                    url: route,
                    data: {
                        product_id: product_id
                    },
                    success: function(response) {
                        if (response.success) {
                            var Qf = $this.parent().closest('.product_div').find('.product_QTY').val();
                            var PrRate = $this.parent().closest('.product_div').find('.product_price');

                            PrRate.attr('data-rate', response.price);


                            //PrRate['prod_rate'] = response.price;
                            //console.log('Org Rate: ' + PrRate.attr('data-rate')); 

                            var t = $("option:selected", $this).text();
                            // console.log('Price_Fx: ' + response.price + '; Qty: ' + Qf + '; ' + t.trim());

                            product_price.val(response.price);

                            //console.log(response.type);
                            //console.log("Price: " + response.price);

                            //console.log("Type:" + response.type + ", Price: " + response.price);

                            if (response.type == 'variable') {
                                var variation_html = "";
                                $.each(response.variations, function(k, v) {
                                    var id = v.id;
                                    var title = v.title;
                                    var price = v.price;
                                    variation_html += "<option value='" + id +
                                        "' data-price='" + price + "'>" +
                                        title + "</option>";
                                });
                                //console.log(variation_html);
                                // select_variation

                                $this.parent().closest('.product_div').find('.variation_div').removeClass('d-none');
                                $this.parent().closest('.product_div').find('.select_variation').html(variation_html);
                                $this.parent().closest('.product_div').find('.select_variation').prepend("<option selected disabled>Select Variation</option>");
                            }

                            // $('#yourSelect').append(selOpts);


                            // $('#product_price-' + response.product_id).html(response.price);
                            // $('.select_variation').removeClass('d-none');
                            // $('.select_variation').data('product-id', response.product_id);
                        }
                    }
                });
            });

            $(document).on('click', '.WQinvoice-product-actions', function() {
                var cnt = $('.repeater-wrapper').length;

                console.log("Deleting-2..., Cnt: " + cnt + ", IsDel: " + IsDeleted);

                if (IsDeleted) {
                    console.log("re-calc");
                    CalcTotal();
                }
            });

            //$(document).on('click','.invoice-product-actions',function(){ $(this).parents().closest(".repeater-wrapper").remove() })


        });

        // function PrintAl()
        // {
        //     var v = 0;
        //     var tot = 0;

        //     // $('.product_price').each(function()
        //     // {
        //     //     v = parseFloat($(this).text());            
        //     //     tot = tot + v;
        //     //     console.log(v)
        //     // });   

        //     $('.product_div').each(function()
        //     {
        //         var $this = $(this);

        //         var vv = $this.find('.product_price');
        //         var PriceVal = parseFloat(vv.text());

        //         vv = $this.find('.product_QTY');
        //         var QtyVal = parseFloat(vv.val());

        //         //console.log(PriceVal);
        //         //console.log(QtyVal);

        //         console.log("Price = " + PriceVal + ", Qty = " + QtyVal);


        //         //console.log($(this))
        //     });        

        //     // console.log("Total = " + tot);

        //     // $('.repeater-wrapper').each(function()
        //     // {
        //     //     var obj = $(this);

        //     //     console.log(obj);
        //     // });        

        //     // $('.repeater-wrapper').each(function(i, obj) {
        //     //      console.log(obj);
        //     // });

        // }

        // function PriceCalcSingle(th)
        // {
        //     var $this = $(this); 

        //     var product_price = th.parent().closest('.product_div').find('.product_price').text();
        //     var product_QTY = th.parent().closest('.product_div').find('.product_QTY').val();

        //     var res = product_price * product_QTY;

        //     //console.log("QTY = " + res);

        //     return res;
        // }
    </script>
@endsection
