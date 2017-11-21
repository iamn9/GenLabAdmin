@extends('adminlte::page_user')
@section('title','Edit')
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>
        Edit listing
    </h1>
    <form method = 'get' action = '{!!url("listing")!!}'>
        <button class = 'btn btn-danger'>listing Index</button>
    </form>
</div>
<div class="box-body">
    <br>
    <form method = 'POST' action = '{!! url("listing")!!}/{!!$listing->
        id!!}/update'> 
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="form-group">
            <label for="owner_id">owner_id</label>
            <input id="owner_id" name = "owner_id" type="text" class="form-control" value="{!!$listing->
            owner_id!!}"> 
        </div>
        <button class = 'btn btn-primary' type ='submit'>Update</button>
    </form>
</div>
</div>
@endsection