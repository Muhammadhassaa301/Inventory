<div class="modal fade" id="addmodulemodal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Add Account Head</h1>
                    <p></p>
                </div>
                <form method="post" action="{{ route('admin.permission.add_module') }}" class="add-new-module">
                    @csrf
                    <input type="hidden" class="active_modal">
                    <div class=" flex-grow-1">
                        <div class="mb-1">
                            <label class="form-label" for="accountFirstName">Name</label>
                            <input type="text" class="form-control" id="accountFirstName" name="title"
                                   placeholder="Title"
                                   value="" data-msg="Please enter title" required/>
                        </div>

                        <button type="submit" class="btn btn-primary me-1 data-submit add_module_btn">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
