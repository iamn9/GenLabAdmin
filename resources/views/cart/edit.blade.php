@extends('adminlte::page')
@section('title','GLS | '.$title)
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>{{$title}}</h1>
    <form method = 'get' action = 'javascript:window.history.back()'>
        <button class = 'btn btn-danger'>back</button>
    </form>
</div>
<div class="box-body">
    <form method = 'POST' action = '{!! url("cart")!!}/{!!$cart->
        id!!}/update'> 
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="form-group">
            <label for="borrower_id">User ID</label>
            <input id="borrower_id" name = "borrower_id" type="text" class="form-control" value="{!!$cart->
            borrower_id!!}" disabled> 
        </div>
        <div class="form-group">
            <label for="status">Remarks</label>
            <textarea id="remarks" name="remarks" class="textarea" style="width: 100%; height: 120px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$cart->remarks}}</textarea>
        </div>
        <button class = 'btn btn-primary' type ='submit'>Update</button>
    </form>
</div>
</div>
@endsection