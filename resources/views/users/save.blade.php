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
                            <input type="text" class="form-control has-error" id="name" name="name" placeholder="Name user" value="">
                        </div>

                        <div class="form-group error">
                            <label for="email" class="control-label">Email</label>
                            <input type="email" class="form-control has-error" id="email" name="email" placeholder="Email user" value="">
                        </div>

                        <div class="form-group error">
                            <label for="password" class="control-label">Password</label>
                            <input type="password" class="form-control has-error" id="password" name="password" placeholder="Password" value="">
                        </div>

						<div class="form-group">
							<label for="role_id" class="control-label">Role</label>
			                <select name="role_id" id="role_id" data-placeholder="Pilih Role" class="chosen-select">
			                	<option></option>
			                    @foreach($roles as $role)
			                    <option value="{{ $role->id }}">{{ $role->name }}</option>
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