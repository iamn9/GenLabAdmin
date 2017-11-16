@extends('adminlte::page')
@section('title','Index')
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>News Index</h1>
     @include('search')
</div>
<div class="box-body">
    <form class = 'col s3' method = 'get' action = '{!!url("news")!!}/create'>
        <button class = 'btn btn-primary' type = 'submit'>Create News</button>
    </form>
    <br>
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th style="width: 170px">Author</th>
            <th style="width: 230px">Date Posted</th>
            <th>News Content</th>
            <th style="width: 180px">Action</th>
        </thead>
        <tbody>
            @foreach($news as $entry) 
            <tr id='{!!$entry->id!!}'>
                <td>{!!$entry->name!!}</td>
                <td>{!!date('F j, Y g:i A', strtotime($entry->date_posted))!!}</td>
                <td>{!!$entry->news!!}</td>
                <td>
                    <a href = '#' data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-xs' data-link = "/news/{!!$entry->id!!}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i>  Delete</a>
                    <a class = 'viewEdit btn btn-warning btn-xs' href = '/news/{!!$entry->id!!}/edit'><i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Edit</a>
                    <a class = 'viewShow btn btn-primary btn-xs' href = '/news/{!!$entry->id!!}'><i class="fa fa-info" aria-hidden="true"></i>  Info</a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    <div class='text-center'>{!! $news->render() !!}</div>
</div>
</div>
@endsection