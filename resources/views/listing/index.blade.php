@extends('adminlte::page')
@section('title','GLS | '.$title)
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>{{$title}}</h1>
    
    
    <form class = 'col s3' method = 'get' action = '{!!url("listing")!!}/create'>
        <button data-toggle="tooltip" title="Create Listing for a User." class = 'btn btn-primary' type = 'submit'><i class="fa fa-plus fa-md" aria-hidden="true"></i>  Create New Listing</button>
    </form>
</div>
<div class="box-body">
    <table class = "dataTable table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th style="width:60px">Shared</th>
            <th>Owner</th>
            <th>Name of List</th>
            <th>Description</th>
            <th>actions</th>
        </thead>
        <tbody>
            @foreach($listings as $listing) 
            <tr id='{!!$listing->id!!}'>
                @if ($listing->isShared)
                    <td><i class='glyphicon glyphicon-ok'></i>  true</td>
                @else
                    <td><i class='glyphicon glyphicon-remove'></i>  false</td>
                @endif
                <td>{!!$listing->getOwner()!!}</td>
                <td>{!!$listing->name!!}</td>
                <td>{!!$listing->description!!}</td>
                <td>
                    <a data-toggle="tooltip" title="Delete this listing." href = '#' data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-xs' data-link = "/listing/{!!$listing->id!!}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i>  Delete</a>
                    <a data-toggle="tooltip" title="Edit listing name and description of this listing." class = 'viewEdit btn btn-primary btn-xs' href = '/listing/{!!$listing->id!!}/edit'><i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Edit</a>
                    <a data-toggle="tooltip" title="Show items and edit QTY of this listing." class = 'viewShow btn btn-info btn-xs' href = '/listing/{!!$listing->id!!}'><i class="fa fa-info" aria-hidden="true"></i>  Info</a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
</div>
</div>
@endsection