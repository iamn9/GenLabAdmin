@extends('adminlte::page_user')
@section('title','GLS | '.$title)
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>{{$title}}</h1>
    <form method = 'get' action = '{!!url("listing")!!}'>
        <button class = 'btn btn-danger'>listing Index</button>
    </form>
</div>
<div class="box-body">
    
    <form method = 'POST' action = '{!! url("listing")!!}/{!!$listing->
        id!!}/update'> 
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="form-group">
            <label for="owner_id">User ID</label>
            @if(Auth::user()->isAdmin)
                <input data-toggle="tooltip" title="Enter User ID Number." id="owner_id" name = "owner_id" type="text" class="form-control" value="{!!$listing->
                owner_id!!}"> 
            @else
                <input data-toggle="tooltip" title="Your ID Number." id="owner_id" name = "owner_id" type="text" class="form-control" value="{!!$listing->
                owner_id!!}" disabled> 
            @endif
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input id="name" name = "name" type="text" class="form-control" value="{!!$listing->name!!}">
        </div>
        <div class="form-group">
            <label for="description">description</label>
            <textarea id="description" name="description" class="textarea" style="width: 100%; height: 120px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!!$listing->description!!}</textarea>
        </div>
        <div class="form-group">
            <label data-toggle="tooltip" title="Allow the listing to be viewed by anyone with a link." for="isShared">Shared</label>
            @if ($listing->isShared)
                <input type="checkbox" name="isShared" checked = "checked">
            @else
                <input type="checkbox" name="isShared">
            @endif
        </div>
        <button class = 'btn btn-primary' type ='submit'>Update</button>
    </form>
</div>
</div>
@endsection