@extends('adminlte::page')
@section('title','Index')
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>Item Index</h1>
    <form method = 'GET'>
        @if($searchWord != "")
            Showing search results for "<b>{{$searchWord}}</b>".
        @endif
        <div class="input-group" >
            <input type="text" name="search" class="form-control pull-right" placeholder="Search" value='{!!$searchWord!!}'>
            <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
</div>

<div class="box-body">
    <form class = 'col s3' method = 'get' action = '{!!url("item")!!}/create'>
        <button class = 'btn btn-primary' type = 'submit'>Create New item</button>
    </form>
    <br>
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach($items as $item) 
            <tr>
                <td>{!!$item->name!!}</td>
                <td>{!!$item->description!!}</td>
                <td>
                    <a href= '/item' class = 'delete btn btn-danger btn-xs' data-link = "/item/{!!$item->id!!}/delete" ><i class="fa fa-trash-o" aria-hidden="true"></i>  Delete</a>
                    <a href = '#' class = 'viewEdit btn btn-primary btn-xs' data-link = '/item/{!!$item->id!!}/edit'><i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Edit</a>
                    <a href = '#' class = 'viewShow btn btn-warning btn-xs' data-link = '/item/{!!$item->id!!}'><i class="fa fa-info" aria-hidden="true"></i>  Info</a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    <div class='text-center'>{!! $items->render() !!}</div>
</div>
</div>
@endsection