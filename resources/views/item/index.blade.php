@extends('adminlte::page')
@section('title','GLS | '.$title)
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>{{$title}}</h1>
    @include('search')
</div>

<div class="box-body">
    <form class = 'col s3' method = 'get' action = '{!!url("item")!!}/create'>
        <button class = 'btn btn-primary' type = 'submit'><i class="fa fa-plus fa-md" aria-hidden="true"></i>  Create New item</button>
    </form>
    <br>
	 <form enctype="multipart/form-data" method="post" role="form">
      <div class="form-group">
          <label for="exampleInputFile">File Upload</label>
          <input type="file" name="file" id="file" size="150">
          <p class="help-block">Only Excel/CSV File Import.</p>
      </div>
      <button type="submit" class="btn btn-primary" name="Import" value="Import">Upload</button>
  </form>
	
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
          <th style="width: 60px">id</th>
          <th style="width: 150px">name</th>
          <th style="width: 150px">brand</th>
          <th style="width: 100px">quantity</th>
            <th>description</th>
            <th style="width: 170px">actions</th>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr id='{!!$item->id!!}'>
                <td>{!!$item->id!!}</td>
                <td>{!!$item->name!!}</td>
                <td>{!!$item->brand!!}</td>
                <td>{!!$item->quantity!!}</td>
                <td>{!!$item->description!!}</td>
                <td>
                    <a data-toggle="tooltip" title="Remove the Item" href = '#' data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-xs' data-link = "/item/{!!$item->id!!}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i>  Delete</a>
                    <a data-toggle="tooltip" title="Edit Item Information" class = 'viewEdit btn btn-primary btn-xs' href = '/item/{!!$item->id!!}/edit'><i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Edit</a>
                    <a class = 'viewShow btn btn-warning btn-xs' href = '/item/{!!$item->id!!}'><i class="fa fa-info" aria-hidden="true"></i>  Info</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class='text-center'>{!! $items->render() !!}</div>
</div>
</div>
@endsection
