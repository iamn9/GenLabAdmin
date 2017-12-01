@extends('adminlte::page')
@section('title','GLS | '.$title)
@section('content')

<div class="box box-primary">
<div class="box-header">
	<h1>{{$title}}</h1>
	@include('search')
	<br/>
	<a data-toggle="tooltip" title="Add new User." href="{{url('users/create')}}" class = "btn btn-primary"><i class="fa fa-plus fa-md" aria-hidden="true"></i> New User</a>
</div>
	<div class="box-body">
		<table class = "table table-hover table-striped table-bordered" style = 'background:#fff'>
			<thead>
				<th>ID Number</th>
				<th>Name</th>
				<th>Email</th>
				<th>Status</th>
				<th>Actions</th>
			</thead>
			<tbody>
				@foreach($users as $user)
				<tr id='{{$user->id}}'>
					<td>{{$user->id_no}}</td>
					<td>{{$user->name}}</td>
					<td>{{$user->email}}</td>
					<td>
						@if($user->isAdmin)
							<span class="label label-success">Admin</span>
						@else
							<span class="label label-info">User</span>
						@endif
						@if($user->isActivated)
							<span class="label label-primary">Activated</span>
						@else
							<span class="label label-warning">Not Activated</span>
						@endif
					</td>
					<td>
						<a data-toggle="tooltip" title="Edit user information." href="{{url('users/edit')}}/{{$user->id}}" class = 'btn btn-primary btn-sm'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
						<a data-toggle="tooltip" title="Delete User." data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-sm' data-link = "/users/{{$user->id}}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	<div class='text-center'>{!! $users->render() !!}</div>
</div>
</div>

@endsection
