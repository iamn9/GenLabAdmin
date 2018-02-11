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
    <form method = 'POST' action = '{!! url("item")!!}/{!!$item->
        id!!}/update'>
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="form-group">
        <label for="name">Name</label>
        <input id="name" name = "name" type="text" class="form-control" required value="{!!$item->name!!}">
    </div>
    <div class="form-group">
        <label class="control-label mb-10">Brand</label>
        <input type="text" name="brand" id="brand" class="form-control" placeholder="" value="{!!$item->brand!!}">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <input id="description" name = "description" type="text" class="form-control" required value="{!!$item->description!!}">
    </div>
    <div class="form-group">
        <label class="control-label mb-10">Quantity</label>
        <input type="number" name="quantity" id="quantity" class="form-control" min="0" value="{!!$item->quantity!!}">
    </div>
    <div class="form-group">
        <label class="control-label mb-10">Wattage</label>
        <input type="number" name="wattage" id="wattage" class="form-control" placeholder="0.00" value="{!!$item->wattage!!}">
    </div>
    <div class="form-group">
        <label class="control-label mb-10">Acquisition cost</label>
        <div class="input-group">
            <span class="input-group-addon">PHP</span>
            <input type="number" name="acquisitioncost" id="acquisitioncost" class="form-control" placeholder="0.00" value="{!!$item->acquisitioncost!!}" step=".01">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label mb-10">First hour rate</label>
        <div class="input-group">
            <span class="input-group-addon">PHP</span>
            <input type="number" name="firsthour" id="firsthour" class="form-control" placeholder="0.00" value="{!!$item->firsthour!!}" step=".01">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label mb-10">Succeeding hour rate</label>
        <div class="input-group">
            <span class="input-group-addon">PHP</span>
            <input type="number" name="succeeding" id="succeeding" class="form-control" placeholder="0.00" value="{!!$item->succeeding!!}" step=".01">
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputFile">Upload Image</label>
        <input data-toggle="tooltip" title="Feature not yet available." type="file" id="image" disabled>
    </div>        <button class = 'btn btn-primary' type ='submit'>Update</button>
    </form>
</div>
</div>
@endsection
