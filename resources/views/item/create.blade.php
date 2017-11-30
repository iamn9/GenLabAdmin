@extends('adminlte::page')
@section('title','GLS | '.$title)
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>{{$title}}</h1>
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
            <input id="name" name = "name" type="text" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="brand">brand</label>
            <input id="brand" name = "brand" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="quantity">quantity</label>
            <input id="quantity" name = "quantity" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="acquisition">acquisition</label>
            <input id="acqusition" name = "acquisition" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="wattage">wattage</label>
            <input id="wattage" name = "wattage" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="firsthour">firsthour</label>
            <input id="firsthour" name = "firsthour" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="succeeding">succeeding</label>
            <input id="succeeding" name = "succeeding" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">description</label>
            <input id="description" name = "description" type="text" class="form-control" required>
        </div>

        <button class = 'btn btn-primary' type ='submit'>Create</button>
    </form>
</div>
</div>
@endsection
