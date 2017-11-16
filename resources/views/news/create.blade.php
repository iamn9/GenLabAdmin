@extends('adminlte::page')
@section('title','Create')
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>Create News</h1>
    <form method = 'get' action = '{!!url("news")!!}'>
        <button class = 'btn btn-danger'>News Index</button>
    </form>
</div>
<div class="box-body">
    <br>
    <form method = 'POST' action = '{!!url("news")!!}'>
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
      
         <div class="form-group">
            <label for="news">News Content</label>
            <input id="news" name = "news" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="reporter_id">Reporter's ID</label>
            <input id="reporter_id" name = "reporter_id" type="text" class="form-control">
        </div>
        
        <button class = 'btn btn-primary' type ='submit'>Create</button>
    </form>
</div>
</div>
@endsection