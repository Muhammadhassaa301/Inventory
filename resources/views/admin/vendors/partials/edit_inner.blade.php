<div class="text-center mb-2">
    <h1 class="mb-1">Edit Vendor</h1>
</div>
<form id="edit-vendor-form" class="row gy-1 pt-75" action="">
    <input type="hidden" class="vendor_id" value="{{ $vendor->id }}">
    <div class="col-12">
        <label class="form-label" for="modalEditVendorTitle">Title</label>
        <input type="text" id="modalEditVendorTitle" name="title" class="form-control"
               value="{{ $vendor->title }}" placeholder="Title" autocomplete="off" required/>
        <div class="text-danger d-none"></div>
    </div>

    <div class="col-12">
        <label class="form-label" for="modalEditVendorAddress">Address</label>
        <textarea class="form-control" id="modalEditVendorAddress" rows="" cols="" name="address" placeholder="Address..." autocomplete="off">{{ $vendor->address }}</textarea>
    </div>

    <div class="col-12 text-center mt-2 pt-50">
        <button type="submit" class="btn btn-primary me-1" id="update_vendor">Update Vendor</button>
        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                aria-label="Close">
            Discard
        </button>
    </div>
</form>
