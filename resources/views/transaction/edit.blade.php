@extends('adminlte::page')
@section('title','Edit')
@section('content')

<section class="content">
    <h1>
        Edit transaction
    </h1>
    <form method = 'get' action = '{!!url("transaction")!!}'>
        <button class = 'btn btn-danger'>transaction Index</button>
    </form>
    <br>
    <form method = 'POST' action = '{!! url("transaction")!!}/{!!$transaction->
        id!!}/update'> 
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="form-group">
            <label for="cart_id">cart_id</label>
            <input id="cart_id" name = "cart_id" type="text" class="form-control" value="{!!$transaction->
            cart_id!!}"> 
        </div>
        <div class="form-group">
            <label for="submitted_at">submitted_at</label>
            <input id="submitted_at" name = "submitted_at" type="text" class="form-control" value="{!!$transaction->
            submitted_at!!}"> 
        </div>
        <div class="form-group">
            <label for="released_at">released_at</label>
            <input id="released_at" name = "released_at" type="text" class="form-control" value="{!!$transaction->
            released_at!!}"> 
        </div>
        <div class="form-group">
            <label for="completed_at">completed_at</label>
            <input id="completed_at" name = "completed_at" type="text" class="form-control" value="{!!$transaction->
            completed_at!!}"> 
        </div>
        <button class = 'btn btn-primary' type ='submit'>Update</button>
    </form>
</section>
@endsection