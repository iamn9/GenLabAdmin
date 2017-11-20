@extends('adminlte::page_user')
@section('title','Show')
@section('content')

<div class="box box-primary">
    <div class="box-header">
        <h1>LISTING CART</h1>
        @include('search')
    </div>
    <div class="box-body">
        <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
            <thead>
                <th style="width: 60px">item_id</th>
                <th>name</th>
                <th style="width: 170px">qty</th>
                <th style="width: 220px">actions</th>
            </thead>
            <tbody>
                @foreach($listing_items as $listing_item) 
                <tr id='{!!$listing_item->id!!}'>
                    <td>{!!$listing_item->item_id!!}</td>
                    <td>{!!$listing_item->name!!}</td>
                    <td>
                        <form method="POST" action='{!! url("listing_item")!!}/{!!$listing_item->id!!}/update'>
                            <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                            <input type = "number" id="qty" name="qty" min="1" value="{!!$cart_item->qty!!}" style="width: 80px;">
                            <button class = 'update btn btn-warning btn-xs' type ='submit' ><i class="fa fa-refresh" aria-hidden="true"></i>  Update</button>
                        </form>
                    </td>
                    <td>
                        <a href = '#' data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-xs' data-link = "/cart_item/{!!$cart_item->id!!}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i>  Remove</a>
                        <a href = '#' data-toggle="modal" data-target="#myModal" class = 'delete btn btn-primary btn-xs' data-link = "/item/{!!$cart_item->item_id!!}/showModal" ><i class="fa fa-info" aria-hidden="true"></i>  Item Info</a>
                    </td>
                </tr>
                @endforeach 
            </tbody>
        </table>
        <div class='text-center'>{!! $listing_items->render() !!}</div><br>
        @if(count($listing_items))
            <div class="input-group">    
            <form method = 'GET' action = '/cart/{{$cart_id}}/checkout'>
                <button class = 'btn btn-success'>CHECKOUT</button>
            </form>
            </div>
        @endif
    </div>
</div>
@endsection