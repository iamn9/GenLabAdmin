@extends('adminlte::page')
@section('title','GLS | '.$title)
@section('content')

	<div class="box box-primary">
		<div class="box-header">
			<h1>{{$title}}</h1>
		</div>
		<div class="box-body">
			<form action="{{url('users/update')}}" method = "post">
				{!! csrf_field() !!}
				<input type="hidden" name = "user_id" value = "{{$user->id}}">
				<div class="form-group">
					<label for="">Name</label>
					<input type="text" name = "name" value = "{{$user->name}}" class = "form-control" required>
				</div>
				<div class="form-group">
					<label for="">Email</label>
					<input type="email" name = "email" value = "{{$user->email}}" class = "form-control" required>
				</div>
				<div class="form-group">
					<label for="">ID Number</label>
					<input type="text" name = "id_no" value = "{{$user->id_no}}" class = "form-control" required>
				</div>
				<div class="form-group">
					<label for="">Password</label>
					<input type="password" name = "password" class = "form-control" placeholder = "password (leave empty to keep password)">
				</div>
				<div class="form-group">
					<label for="isAdmin">Admin</label>
					@if ($user->isAdmin())
						<input type="checkbox" name="isAdmin" checked = "checked">
					@else
						<input type="checkbox" name="isAdmin">
					@endif
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<label for="isActivated">Activated</label>
					@if ($user->isActivated())
						<input type="checkbox" name="isActivated" checked = "checked">
					@else
						<input type="checkbox" name="isActivated">
					@endif
				</div>
				<button class = "btn btn-primary" type="submit">Update</button>
			</form>
		</div>
	</div>

@endsection
