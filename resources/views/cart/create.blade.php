@extends('adminlte::page')
@section('title','Create')
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>Create cart</h1>
    <form method = 'get' action = '{!!url("cart")!!}'>
        <button class = 'btn btn-danger'>cart Index</button>
    </form>
</div>
<div class="box-body">
    <br>
    <form method = 'POST' action = '{!!url("cart")!!}'>
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="form-group">
            <label for="borrower_id">borrower_id</label>
            <input id="borrower_id" name = "borrower_id" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="status">status</label>

            <select id="status" name="status" class="form-control">
                <option>Draft</option>
                <option>Pending</option>
                <option>Disbursed</option>
                <option>Completed</option>
            </select>
        </div>
        <button class = 'btn btn-primary' type ='submit'>Create</button>
    </form>
</div>
</div>
@endsection