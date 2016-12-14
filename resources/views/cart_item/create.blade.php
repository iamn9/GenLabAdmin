@extends('scaffold-interface.layouts.app')
@section('title','Create')
@section('content')

<section class="content">
    <h1>
        Create cart_item
    </h1>
    <form method = 'get' action = '{!!url("cart_item")!!}'>
        <button class = 'btn btn-danger'>cart_item Index</button>
    </form>
    <br>
    <form method = 'POST' action = '{!!url("cart_item")!!}'>
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="form-group">
            <label for="cart_id">cart_id</label>
            <input id="cart_id" name = "cart_id" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="item_id">item_id</label>
            <input id="item_id" name = "item_id" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="qty">qty</label>
            <input id="qty" name = "qty" type="text" class="form-control">
        </div>
        <button class = 'btn btn-primary' type ='submit'>Create</button>
    </form>
</section>
@endsection