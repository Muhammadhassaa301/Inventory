<div class="text-center mb-2">
    <h1 class="mb-1">Edit Brand</h1>
</div>
<form id="edit-brand-form" class="row gy-1 pt-75" action="">
    <input type="hidden" class="brand_id" value="{{ $brand->id }}">
    <div class="col-12">
        <label class="form-label" for="modalEditBrandTitle">Title</label>
        <input type="text" id="modalEditBrandTitle" name="title" class="form-control"
               value="{{ $brand->title }}" placeholder="Title" autocomplete="off" required/>
        <div class="text-danger d-none"></div>
    </div>

    <div class="col-12">
        <label class="form-label" for="modalEditBrandDescription">Description</label>
        <textarea class="form-control" id="modalEditBrandDescription" rows="10" cols="10" name="description" placeholder="Description..." autocomplete="off">{{ $brand->description }}</textarea>
    </div>

    <div class="col-12 text-center mt-2 pt-50">
        <button type="submit" class="btn btn-primary me-1" id="update_brand">Update Brand</button>
        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                aria-label="Close">
            Discard
        </button>
    </div>
</form>
