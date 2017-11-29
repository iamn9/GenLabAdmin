@extends('adminlte::page')
@section('title','GLS | '.$title)
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>{{$title}}</h1>
    <form method = 'get' action = '{!!url("news")!!}'>
        <button class = 'btn btn-danger'>News Index</button>
    </form>
</div>
<div class="box-body">
    <br>
    <form method = 'POST' action = '{!!url("news")!!}'>
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="form-group">
            <label for="title">title</label>
            <input id="title" name = "title" type="text" class="form-control">
        </div>
         <div class="form-group">
            <label for="content">News Content</label>
            <textarea id="content" name="content" class="textarea form-control" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea> 
        </div>
        <button class = 'btn btn-primary' type ='submit'>Create</button>
    </form>
</div>
</div>
@endsection