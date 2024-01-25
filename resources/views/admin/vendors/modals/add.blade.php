<div class="modal fade" id="addVendorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-add-vendor">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-add-vendor"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Add Vendor</h1>
                </div>
                <form id="add-vendor-form" class="row gy-1 pt-75" action="">
                    <div class="col-12">
                        <label class="form-label" for="modalAddTitle">Title</label>
                        <input type="text" id="modalAddTitle" name="title" class="form-control"
                               placeholder="Title" autocomplete="off" required/>
                        <div class="text-danger d-none"></div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="modalAddAddress">Address</label>
                        <textarea class="form-control" id="modalAddAddress" rows="" cols="" name="address" placeholder="Address..." autocomplete="off"></textarea>
                    </div>

                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit" class="btn btn-primary me-1" id="create_vendor">Create Vendor</button>
                        <button type="reset" class="btn btn-outline-secondary add-vendor-close-btn" data-bs-dismiss="modal"
                                aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

