@extends('scaffold-interface.layouts.app')
@extends('adminlte::page')
@section('title','Edit')
@section('content')

<section class="content">
    <h1>
        Edit item
    </h1>
    <form method = 'get' action = '{!!url("item")!!}'>
        <button class = 'btn btn-danger'>item Index</button>
    </form>
    <br>
    <form method = 'POST' action = '{!! url("item")!!}/{!!$item->
        id!!}/update'> 
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="form-group">
            <label for="name">name</label>
            <input id="name" name = "name" type="text" class="form-control" value="{!!$item->
            name!!}"> 
        </div>
        <div class="form-group">
            <label for="description">description</label>
            <input id="description" name = "description" type="text" class="form-control" value="{!!$item->
            description!!}"> 
        </div>
        <button class = 'btn btn-primary' type ='submit'>Update</button>
    </form>
</section>
@endsection