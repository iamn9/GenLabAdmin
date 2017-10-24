@extends('adminlte::page_user')
@section('title','Show')
@section('content')

<div class="box box-primary">
    <div class="box-header">
        <h1>USER CART</h1>
        @include('search')
    </div>
    <div class="box-body">
        <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
            <thead>
                <th style="width: 60px">item_id</th>
                <th>name</th>
                <th style="width: 80px">qty</th>
                <th style="width: 200px">actions</th>
            </thead>
            <tbody>
                @foreach($cart_items as $cart_item) 
                <tr>
                    <td>{!!$cart_item->item_id!!}</td>
                    <td>{!!$cart_item->name!!}</td>
                    <td>{!!$cart_item->qty!!}</td>
                    <td>
                        <a href = '#' data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-xs' data-link = "/cart_item/{!!$cart_item->id!!}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i>  Remove</a>
                        <a href = '#' class = 'viewEdit btn btn-warning btn-xs' data-link = '/cart_item/{!!$cart_item->id!!}/edit'><i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Edit</a>
                        <a href = '#' data-toggle="modal" data-target="#myModal" class = 'delete btn btn-primary btn-xs' data-link = "/item/{!!$cart_item->item_id!!}/showModal" ><i class="fa fa-info" aria-hidden="true"></i>  Item Info</a>
                    </td>
                </tr>
                @endforeach 
            </tbody>
        </table>
        <div class='text-center'>{!! $cart_items->render() !!}</div>
            <br>
        @if(!is_null($cart_id))
        <div class="input-group">    
        <form method = 'GET' action = '/cart/{{$cart_id}}/checkout'>
            <button class = 'btn btn-success'>CHECKOUT</button>
        </form>
        @endif
        </div>
    </div>
</div>
@endsection