@extends('adminlte::page_user')
@section('title','GLS | '.$title)
@section('content')

<div class="box box-primary">
    <div class="box-header">
        <h1>{{$title}}</h1>
        @include('search')
    </div>
    <div class="box-body">
        <br>
        <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th style="width: 60px">id</th>
            <th style="width: 200px">name</th>
            <th style="width: 150px">brand</th>
            <th>description</th>
            <th style="width: 60px">qty</th>
            <th style="width: 280px">actions</th>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr id='{!!$item->id!!}'>
                <td>{!!$item->id!!}</td>
                <td>{!!$item->name!!}</td>
                <td>{!!$item->brand!!}</td>
                <td>{!!$item->description!!}</td>
                <td>{!!$item->quantity!!}</td>
                <td>
                    <a data-toggle="tooltip" title="Add item to your current cart." data-toggle="modal" data-target="#myModal" class = 'delete btn btn-success btn-xs' data-link = "/cart/add/{!!$item->id!!}/addItemMsg" ><i class="fa fa-cart-plus" aria-hidden="true"></i>  Add to Cart</a>
                    <a data-toggle="tooltip" title="Add item to the listing of your choice." data-toggle="modal" data-target="#myModal" class = 'create btn btn-success btn-xs' data-link = "/listing/add/{!!$item->id!!}/addItemMsg" ><i class="fa fa-book" aria-hidden="true"></i>  Add to Listing</a>
                    <a data-toggle="tooltip" title="Show Item Information." class = 'viewShow btn btn-primary btn-xs' href = '/item/{!!$item->id!!}'><i class="fa fa-info" aria-hidden="true"></i>  Info</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class='text-center'>{!! $items->render() !!}</div>
    </div>
</div>

</div>
@endsection
