@extends('adminlte::page_user')
@section('title','GLS | '.$title)
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>{{$title}}</h1>
    
    <br>
    <form method = 'get' action = '{!!url("cart")!!}'>
        <button class = 'btn btn-primary'>cart Index</button>
    </form>
    <br>
    <table class = 'table table-bordered'>
        <thead>
            <th>Key</th>
            <th>Value</th>
        </thead>
        <tbody>
            <tr>
                <td>
                    <b><i>Borrower ID : </i></b>
                </td>
                <td>{!!$cart->borrower_id!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>Status : </i></b>
                </td>
                <td>{!!$cart->status!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>Remarks : </i></b>
                </td>
                <td>{!!$cart->remarks!!}</td>
            </tr>
        </tbody>
    </table>
</div>
<div class="box-body">
    <table class = "dataTable table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th style="width: 30px">ItemID</th>
            <th>Name</th>
            <th style="width: 30px">Qty</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach($cart_items as $cart_item) 
            <tr>
                <td><a href="item/{!!$cart_item->item_id!!}">{!!$cart_item->item_id!!}</a></td>
                <td>{!!$cart_item->name!!}</td>
                <td>{!!$cart_item->qty!!}</td>
                <td>
                    @if($cart->status =="Draft")
                        <a data-toggle="tooltip" title="Remove item from cart." href = '{!!url("cart")."/".$cart_item->cart_id!!}' data-link='/cart_item/{!!$cart_item->id!!}/delete' class = 'delete btn btn-danger btn-xs'><i class = 'material-icons'>delete</i></a>
                        <a href = '#' class = 'viewEdit btn btn-warning btn-xs' data-link = '/cart_item/{!!$cart_item->id!!}/edit'><i class = 'material-icons'>edit</i></a>
                    @endif
                    <a href = '/item/{!!$cart_item->item_id!!}' class = 'delete btn btn-primary btn-xs' ><i class="fa fa-info" aria-hidden="true"></i>  Item Info</a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
</div>
</div>
@endsection