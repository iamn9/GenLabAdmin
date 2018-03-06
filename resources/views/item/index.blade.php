@extends('adminlte::page')
@section('title','GLS | '.$title)
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>{{$title}}</h1>
    <!--  -->
    <form class = 'col s3' method = 'get' action = '{!!url("item")!!}/create'>
      <button class = 'btn btn-primary addBtn' type = 'submit'><i class="fa fa-plus fa-md" aria-hidden="true"></i>  Add New Item</button>
	  <a data-toggle="tooltip" title="Feature not yet available." class = 'upload btn btn-primary' href='#' disabled> Import from file</a>
    </form>		
</div>

<div class="box-body">
    <table class = "dataTable table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th style="width: 30px">ID</th>
            <th>Name</th>
            <th>Brand</th>
            <th style="width: 30px">Qty</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr id='{!!$item->id!!}'>
                <td>{!!$item->id!!}</td>
                <td>{!!$item->name!!}</td>
                <td>{!!$item->brand!!}</td>
                <td>{!!$item->quantity!!}</td>
                <td>
                    <a data-toggle="tooltip" title="Remove the Item" href = '#' data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-xs' data-link = "/item/{!!$item->id!!}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i>  Delete</a>
                    <a data-toggle="tooltip" title="Edit Item Information" class = 'viewEdit btn btn-primary btn-xs' href = '/item/{!!$item->id!!}/edit'><i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Edit</a>
                    <a class = 'viewShow btn btn-warning btn-xs' href = '/item/{!!$item->id!!}'><i class="fa fa-info" aria-hidden="true"></i>  Info</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection
