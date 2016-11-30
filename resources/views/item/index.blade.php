@extends('scaffold-interface.layouts.app')
@extends('adminlte::page')
@section('title','Index')
@section('content')

<section class="content">
    <h1>
        Item Index
    </h1>
    <form class = 'col s3' method = 'get' action = '{!!url("item")!!}/create'>
        <button class = 'btn btn-primary' type = 'submit'>Create New item</button>
    </form>
    <br>
    <br>
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th>name</th>
            <th>description</th>
            <th>actions</th>
        </thead>
        <tbody>
            @foreach($items as $item) 
            <tr>
                <td>{!!$item->name!!}</td>
                <td>{!!$item->description!!}</td>
                <td>
                    <a data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-xs' data-link = "/item/{!!$item->id!!}/deleteMsg" ><i class = 'material-icons'>delete</i></a>
                    <a href = '#' class = 'viewEdit btn btn-primary btn-xs' data-link = '/item/{!!$item->id!!}/edit'><i class = 'material-icons'>edit</i></a>
                    <a href = '#' class = 'viewShow btn btn-warning btn-xs' data-link = '/item/{!!$item->id!!}'><i class = 'material-icons'>info</i></a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    {!! $items->render() !!}

</section>
@endsection