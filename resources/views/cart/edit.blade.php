@extends('scaffold-interface.layouts.app')
@section('title','Edit')
@section('content')

<section class="content">
    <h1>
        Edit cart
    </h1>
    <form method = 'get' action = '{!!url("cart")!!}'>
        <button class = 'btn btn-danger'>cart Index</button>
    </form>
    <br>
    <form method = 'POST' action = '{!! url("cart")!!}/{!!$cart->
        id!!}/update'> 
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="form-group">
            <label for="borrower_id">borrower_id</label>
            <input id="borrower_id" name = "borrower_id" type="text" class="form-control" value="{!!$cart->
            borrower_id!!}"> 
        </div>
        <div class="form-group">
            <label for="status">status</label>
            <input id="status" name = "status" type="text" class="form-control" value="{!!$cart->
            status!!}"> 
        </div>
        <button class = 'btn btn-primary' type ='submit'>Update</button>
    </form>
</section>
@endsection