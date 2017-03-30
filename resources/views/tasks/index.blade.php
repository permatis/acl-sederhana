@extends('layouts.app')
@section('title-page', 'Tasks')

@section('content')
	<div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">List All Task</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
			<table class="table no-margin" id="table">
				<thead>
					<tr>
						<th>Name</th>
						<th>Description</th>
						<th>Update At</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
        </div>
        <div class="box-footer clearfix">
        	<button class="btn btn-sm btn-default btn-flat pull-left" id="btn-new">Create Task</button>
        </div>
    </div>

	@include('tasks.save')
	@include('partials.delete')

    @push('script')
    <script type="text/javascript">
    	$(function() {
    		// define datatables
			$('#table').DataTable({
			 	'processing': true, 
			 	'serverSide': true,
			 	'ajax': {
			 		'url': '{{ url('/') }}/api/v1/ajax/tasks',
			 		'type': 'POST'
			 	},
		        columns: [
		            { data: 'name', name: 'name' },
		            { data: 'description', name: 'description' },
		            { data: 'updated_at', name: 'updated_at' },
		            { data: 'action', name: 'action', orderable: false, searchable: false}
		        ]
		    });
    	});
    </script>
    @endpush
	
@endsection