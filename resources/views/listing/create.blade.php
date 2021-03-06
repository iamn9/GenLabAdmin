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
    
    <form method = 'POST' action = '{!!url("listing")!!}'>
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="form-group">
            <label for="owner_id">User ID</label>
            @if(Auth::user()->isAdmin)
                <input id="owner_id" name = "owner_id" type="text" class="form-control">
            @else
                <input id="owner_id" name = "owner_id" type="text" class="form-control" value="{!!Auth::user()->id_no!!}" disabled>
            @endif
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input id="name" name = "name" type="text" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">description</label>
            <textarea id="description" name="description" class="textarea" style="width: 100%; height: 120px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
        </div>
        <div class="form-group">
            <label for="isShared">Shared</label>
            <input type="checkbox" name="isShared">
        </div>
        <button class = 'btn btn-primary' type ='submit'>Create</button>
    </form>
</div>
</div>
@endsection