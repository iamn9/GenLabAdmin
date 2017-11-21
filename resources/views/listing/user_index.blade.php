@extends('adminlte::page_user')
@section('title','Index')
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>{{$title}}</h1>
    @include('search')
    <br>
    <form class = 'col s3' method = 'get' action = '{!!url("listing")!!}/create'>
        <button class = 'btn btn-primary' type = 'submit'>Create New Listing</button>
    </form>
</div>
<div class="box-body">
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th style="width:200px">owner_id</th>
            <th>Borrower Name</th>
            <th style="width: 200px">actions</th>
        </thead>
        <tbody>
            @foreach($listings as $listing) 
            <tr id='{!!$listing->id!!}'>
                <td>{!!$listing->owner_id!!}</td>
                <td>{!!$listing->getOwner()!!}</td>
                <td>
                    <a href = '#' data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-xs' data-link = "/listing/{!!$listing->id!!}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i>  Delete</a>
                    <a class = 'viewEdit btn btn-primary btn-xs' href = '/listing/{!!$listing->id!!}/edit'><i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Edit</a>
                    <a class = 'viewShow btn btn-info btn-xs' href = '/listing/{!!$listing->id!!}'><i class="fa fa-info" aria-hidden="true"></i>  Info</a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    <div class='text-center'>{!! $listings->render() !!}</div>
</div>
</div>
@endsection