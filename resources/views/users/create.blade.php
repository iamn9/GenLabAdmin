@extends('adminlte::page')
@section('title','GLS | '.$title)
@section('content')

	<div class="box box-primary">
		<div class="box-header">
			<h1>{{$title}}</h1>
		</div>
		<div class="box-body">
			<form action="{{url('users/store')}}" method = "post">
				{!! csrf_field() !!}
				<input type="hidden" name = "user_id">
				<div class="form-group">
					<label for="">Name</label>
					<input type="text" name = "name" class = "form-control" placeholder = "Name">
				</div>
				<div class="form-group">
					<label for="">Email</label>
					<input type="email" name = "email" class = "form-control" placeholder = "Email" required>
				</div>
				<div class="form-group">
					<label for="">ID Number</label>
					<input type="text" name = "id_no" class = "form-control" placeholder = "Name" required>
				</div>
				<div class="form-group">
					<label for="">Password</label>
					<input type="password" name = "password" class = "form-control" placeholder = "Password" required>
				</div>
				<div class="form-group">
					<label data-toggle="tooltip" title="User is a GenLab Staff." for="isAdmin">Admin</label>
					<input type="checkbox" name="isAdmin">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<label data-toggle="tooltip" title="Activate Account." for="isActivated">Activated</label>
					<input type="checkbox" name="isActivated">
				</div>
				<button class = "btn btn-primary" type="submit">Create</button>
			</form>
		</div>
	</div>
@endsection
