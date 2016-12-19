@extends('adminlte::page')
@section('title','Create')
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>
        Create item
    </h1>
    <form method = 'get' action = '{!!url("item")!!}'>
        <button class = 'btn btn-danger'>item Index</button>
    </form>
</div>
<div class="box-body">
    <br>
    <form method = 'POST' action = '{!!url("item")!!}'>
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="form-group">
            <label for="name">name</label>
            <input id="name" name = "name" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">description</label>
            <input id="description" name = "description" type="text" class="form-control">
        </div>
        <button class = 'btn btn-primary' type ='submit'>Create</button>
    </form>
</div>
</div>
@endsection