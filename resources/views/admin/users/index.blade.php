@extends('layouts.app')
@section('content')
<div class="card">
	<div class="card-header">
		<h5>Users</h5>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped table-hover dataTable">
				<thead>
					<th>Name</th>
					<th>Email</th>
					<th>Action(s)</th>
				</thead>
				<tbody>
					@foreach($users as $user)
					<tr>
						<td>{{ $user->name }}</td>
						<td>{{ $user->email }}</td>
						<td>
							<a href="javascript:void(0)" data-url="{{ url('admin/edit_user/'.$user->id) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Edit User')}}" data-size="lg" title="{{__('Edit User Details')}}" data-title="{{__('Edit User Details')}}" >Edit</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection