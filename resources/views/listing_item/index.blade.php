@extends('adminlte::page')
@section('title','Index')
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>ADMIN: listing_item Index</h1>
    @include('search')
    <br>
    <form class = 'col s3' method = 'get' action = '{!!url("listing_item")!!}/create'>
        <button class = 'btn btn-primary' type = 'submit'>Create New listing_item</button>
    </form>
</div>
<div class="box-body">
    <br>
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th>listing_id</th>
            <th>item_id</th>
            <th>qty</th>
            <th>actions</th>
        </thead>
        <tbody>
            @foreach($listing_items as $listing_item) 
            <tr id='{!!$listing_item->id!!}'>
                <td>{!!$listing_item->listing_id!!}</td>
                <td>{!!$listing_item->item_id!!}</td>
                <td>{!!$listing_item->qty!!}</td>
                <td>
                    <a href = '{!!url("/listing_item")!!}' data-link='/listing_item/{!!$listing_item->id!!}/delete' class = 'delete btn btn-danger btn-xs'><i class = 'material-icons'>delete</i></a>
                    <a href = '#' class = 'viewEdit btn btn-primary btn-xs' data-link = '/listing_item/{!!$listing_item->id!!}/edit'><i class = 'material-icons'>edit</i></a>
                    <a href = '#' class = 'viewShow btn btn-warning btn-xs' data-link = '/listing_item/{!!$listing_item->id!!}'><i class = 'material-icons'>info</i></a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    <div class='text-center'>{!! $listing_items->render() !!}</div>
</div>
</div>
@endsection