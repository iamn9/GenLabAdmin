@extends('scaffold-interface.layouts.app')
@section('title','Edit')
@section('content')

<section class="content">
    <h1>
        Edit cart_item
    </h1>
    <form method = 'get' action = '{!!url("cart_item")!!}'>    <!--RETURN TO PREVIOUS PAGE-->
        <button type="button" class = 'btn btn-danger' onclick="javascript:history.back()">Back</button>
        
    </form>
    <br>
    <form method = 'POST' action = '{!! url("cart_item")!!}/{!!$cart_item->
        id!!}/update'> 
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="form-group">
            <label for="cart_id">cart_id</label>
            <input id="cart_id" name = "cart_id" type="text" class="form-control" value="{!!$cart_item->
            cart_id!!}"> 
        </div>
        <div class="form-group">
            <label for="item_id">item_id</label>
            <input id="item_id" name = "item_id" type="text" class="form-control" value="{!!$cart_item->
            item_id!!}"> 
        </div>
        <div class="form-group">
            <label for="qty">qty</label>
            <input id="qty" name = "qty" type="text" class="form-control" value="{!!$cart_item->
            qty!!}"> 
        </div>
        <button class = 'btn btn-primary' type ='submit'>Update</button>
    </form>
</section>
@endsection