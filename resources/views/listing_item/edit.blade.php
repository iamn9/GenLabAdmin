@extends('adminlte::page')
@section('title','Edit')
@section('content')

<section class="content">
<div class="box box-primary">
<div class="box-header">
    <h1>Edit listing_item</h1>
    <form method = 'get' action = '{!!url("listing_item")!!}'>    <!--RETURN TO PREVIOUS PAGE-->
        <button type="button" class = 'btn btn-danger' onclick="javascript:history.back()">Back</button>
    </form>
</div>
<div class="box-body">
    <br>
    <form method = 'POST' action = '{!! url("listing_item")!!}/{!!$listing_item->
        id!!}/update'> 
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="form-group">
            <label for="listing_id">listing_id</label>
            <input id="listing_id" name = "listing_id" type="text" class="form-control" value="{!!$listing_item->
            listing_id!!}"> 
        </div>
        <div class="form-group">
            <label for="item_id">item_id</label>
            <input id="item_id" name = "item_id" type="text" class="form-control" value="{!!$listing_item->
            item_id!!}"> 
        </div>
        <div class="form-group">
            <label for="qty">qty</label>
            <input id="qty" name = "qty" type="text" class="form-control" value="{!!$listing_item->
            qty!!}"> 
        </div>
        <button class = 'btn btn-primary' type ='submit'>Update</button>
    </form>
</div>
</div>
</section>
@endsection