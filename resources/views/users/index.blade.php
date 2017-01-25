@extends('adminlte::page')
@section('content')

<div class="box box-primary">
<div class="box-header">
	<h1>All Users</h1>
	<form method = 'GET'>
	<div class="input-group" >
        <input type="text" name="search" class="form-control pull-right" placeholder="Search" value='{!!$searchWord!!}'>
        <div class="input-group-btn">
            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
        </div>
    </div>
    </form>
</div>
	<div class="box-body">
		<a href="{{url('users/create')}}" class = "btn btn-success"><i class="fa fa-plus fa-md" aria-hidden="true"></i> New</a>
		<table class = "table table-hover">
		<thead>
			<th>ID Number</th>
			<th>Name</th>
			<th>Email</th>
			<th>Status</th>
			<th>Actions</th>
		</thead>
		<tbody>
			@foreach($users as $user)
			<tr>
				<td>{{$user->id_no}}</td>
				<td>{{$user->name}}</td>
				<td>{{$user->email}}</td>
				<td>
					@if($user->isAdmin)
						<span class="label label-success">Admin</span>
					@endif
					@if($user->isActivated)
						<span class="label label-primary">Activated</span>
					@else
						<span class="label label-warning">Not Activated</span>
					@endif
				</td>
				<td>
					<a href="{{url('users/edit')}}/{{$user->id}}" class = 'btn btn-primary btn-sm'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
					<a href="{{url('users/delete')}}/{{$user->id}}" class = "btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<div class='text-center'>{!! $users->render() !!}</div>
</div>
</div>

@endsection
