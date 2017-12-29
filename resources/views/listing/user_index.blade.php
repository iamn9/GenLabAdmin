@extends('adminlte::page_user')
@section('title','GLS | '.$title)
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>{{$title}}</h1>
    @include('search')
    <br>
    <form class = 'col s3' method = 'get' action = '{!!url("listing")!!}/create'>
        <button class = 'btn btn-primary' type = 'submit'><i class="fa fa-plus fa-md" aria-hidden="true"></i>  Create New Listing</button>
    </form>
</div>
<div class="box-body">
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th style="width:80px">Shared</th>
            <th style="width:130px">owner_id</th>
            <th style="width:200px">Borrower</th>
            <th style="width:200px">Name of List</th>
            <th>Description</th>
            <th style="width: 250px">actions</th>
        </thead>
        <tbody>
            @foreach($listings as $listing) 
            <tr id='{!!$listing->id!!}'>
            @if ($listing->isShared)
                <td><i class='glyphicon glyphicon-ok'></i>  true</td>
            @else
                <td><i class='glyphicon glyphicon-remove'></i>  false</td>
            @endif
            <td>{!!$listing->owner_id!!}</td>
                <td>{!!$listing->getOwner()!!}</td>
                <td>{!!$listing->name!!}</td>
                <td>{!!$listing->description!!}</td>
                <td>
                    <a href = '#' data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-xs' data-link = "/listing/{!!$listing->id!!}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i>  Delete</a>
                    <a class = 'viewEdit btn btn-primary btn-xs' href = '/listing/{!!$listing->id!!}/edit'><i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Edit</a>
                    <a class = 'viewShow btn btn-info btn-xs' href = '/listing/{!!$listing->id!!}'><i class="fa fa-info" aria-hidden="true"></i>  Info</a>
                    @if($listing->getSize() > 0)
                        <a class = 'update btn btn-success btn-xs' href = '/listing/{!!$listing->id!!}/addToCart/process'><i class="fa fa-cart-plus" aria-hidden="true"></i>  Add to Cart</a>
                    @endif
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    <div class='text-center'>{!! $listings->render() !!}</div>
</div>
</div>
@endsection