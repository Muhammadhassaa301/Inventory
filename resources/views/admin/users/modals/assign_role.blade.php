<div class="modal fade" id="assignrole" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Assign Role</h1>
                    <p></p>
                </div>
                <form id="assign-role-form" method="post" action="{{ route('admin.user.assign_role1') }}"
                      class="">
                    @csrf
                    <input type="hidden" name="user_id" class="user_id" value="">
                    <div class="flex-grow-1 fields">
                        <div class="mb-1">
                            <label class="form-label" for="assign-role">Role</label>
                            <select id="assign-role" name="roles[]" multiple
                                    class="form-select"
                                    required>
                                <option value="">Select Role</option>


                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary me-1 data-submit">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
