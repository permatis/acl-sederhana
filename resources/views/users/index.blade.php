@extends('layouts.app')
@section('title-page', 'Users')

@section('content')
@can('view-user')
	<div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">List All Users</h3>
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
						<th>Email</th>
						<th>Update At</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
        </div>
        <div class="box-footer clearfix">
        	<button class="btn btn-sm btn-default btn-flat pull-left" id="btn-new">Create User</button>
        </div>
    </div>

	@include('users.save')
	@include('partials.delete')

    @push('script')
    <script type="text/javascript">
    	$(function() {
    		// define datatables
			$('#table').DataTable({
			 	'processing': true, 
			 	'serverSide': true,
			 	'ajax': {
			 		'url': '{{ url('/') }}/api/v1/ajax/users',
			 		'type': 'POST'
			 	},
		        columns: [
		            { data: 'name', name: 'name' },
		            { data: 'email', name: 'email' },
		            { data: 'updated_at', name: 'updated_at' },
		            { data: 'action', name: 'action', orderable: false, searchable: false}
		        ]
		    });
    	});
    </script>
    @endpush
	@endcan
@endsection