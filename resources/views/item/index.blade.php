@extends('adminlte::page')
@section('title','Index')
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>Item Index</h1>
    @include('search')
</div>

<div class="box-body">
    <form class = 'col s3' method = 'get' action = '{!!url("item")!!}/create'>
        <button class = 'btn btn-primary' type = 'submit'>Create New item</button>
    </form>
    <br>
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th style="width: 60px">id</th>
            <th style="width: 210px">name</th>
            <th>description</th>
            <th style="width: 180px">actions</th>
        </thead>
        <tbody>
            @foreach($items as $item) 
            <tr>
                <td>{!!$item->id!!}</td>
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