@extends('scaffold-interface.layouts.app')
@section('title','Show')
@section('content')

<section class='content'>
<div class="box box-primary">
<div class="box-header">
    <h1>USER CART</h1>
</div>
<div class="box-body">
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th>item_id</th>
            <th>name</th>
            <th>qty</th>
            <th>actions</th>
        </thead>
        <tbody>
            @foreach($cart_items as $cart_item) 
            <tr>
                <td>{!!$cart_item->item_id!!}</td>
                <td>{!!$cart_item->name!!}</td>
                <td>{!!$cart_item->qty!!}</td>
                <td>
                    <a href = '#' data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-xs' data-link = "/cart_item/{!!$cart_item->id!!}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i>  Remove</a>
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
</section>
@endsection