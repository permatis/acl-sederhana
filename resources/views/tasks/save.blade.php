<!-- Modal for create & posts --> 
<div class="modal fade" id="modals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Create Task</h4>
            </div>
            <div class="modal-body">
                <form id="forms">
                	<input type="hidden" name="id" id="id" value="">
					<div class="container-fluid">
                        <div class="form-group error">
                            <label for="name" class="control-label">Task</label>
                            <input type="text" class="form-control has-error" id="name" name="name" placeholder="Task" value="">
                        </div>

                        <div class="form-group">
                            <label for="description" class="control-label">Description</label>
                            <textarea id="description" class="form-control" name="description" placeholder="Description"></textarea>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-save" class="btn-save" value="add">Save changes</button>
                <input type="hidden" id="task_id" name="task_id" value="0">
            </div>
        </div>
    </div>
</div>
<!-- End modal for create & post -->