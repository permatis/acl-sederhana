<!-- Modal for create & posts --> 
<div class="modal fade" id="modals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Create Role</h4>
            </div>
            <div class="modal-body">
                <form id="forms">
                	<input type="hidden" name="id" id="id" value="">
					<div class="container-fluid">
                        <div class="form-group error">
                            <label for="name" class="control-label">Name</label>
                            <input type="text" class="form-control has-error" id="name" name="name" placeholder="Name role" value="">
                        </div>

                        <div class="form-group">
                            <label for="description" class="control-label">Description</label>
                            <textarea id="description" class="form-control" name="description" placeholder="Description"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="permission_id" class="control-label">Role</label>
                            <select name="permission_id[]" id="permission_id" data-placeholder="Pilih Role" class="chosen-select" multiple="multiple">
                                <option></option>
                                @foreach($permissions as $perm)
                                <option value="{{ $perm->id }}">{{ $perm->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-save" class="btn-save" value="add">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- End modal for create & post -->