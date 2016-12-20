@extends('adminlte::page')
@section('title','Create')
@section('content')

<section class="content">
    <h1>
        Create transaction
    </h1>
    <form method = 'get' action = '{!!url("transaction")!!}'>
        <button class = 'btn btn-danger'>transaction Index</button>
    </form>
    <br>
    <form method = 'POST' action = '{!!url("transaction")!!}'>
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="form-group">
            <label for="cart_id">cart_id</label>
            <input id="cart_id" name = "cart_id" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="submitted_at">submitted_at</label>
            <input id="submitted_at" name = "submitted_at" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="disbursed_at">disbursed_at</label>
            <input id="disbursed_at" name = "disbursed_at" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="completed_at">completed_at</label>
            <input id="completed_at" name = "completed_at" type="text" class="form-control">
        </div>
        <button class = 'btn btn-primary' type ='submit'>Create</button>
    </form>
</section>
@endsection