@extends('adminlte::page')
@section('title','GLS | '.$title)
@section('content')

<section class='content'>
<div class="box box-primary">
<div class="box-header">
    <h1>{{$title}}</h1>
    @include('search')
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
                    <b><i>borrower_id : </i></b>
                </td>
                <td>{!!$cart->borrower_id!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>status : </i></b>
                </td>
                <td>{!!$cart->status!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>remarks : </i></b>
                </td>
                <td>{!!$cart->remarks!!}</td>
            </tr>
        </tbody>
    </table>
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
                    @if($cart->status != "Completed" && $cart->status != "Released")
                        <a href = '{!!url("cart")."/".$cart_item->cart_id!!}' data-link='/cart_item/{!!$cart_item->id!!}/delete' class = 'delete btn btn-danger btn-xs'><i class = 'material-icons'>delete</i></a>
                        <a href = '#' class = 'viewEdit btn btn-warning btn-xs' data-link = '/cart_item/{!!$cart_item->id!!}/edit'><i class = 'material-icons'>edit</i></a>
                    @endif
                    <a href = '/item/{!!$cart_item->item_id!!}' class = 'delete btn btn-primary btn-xs' ><i class="fa fa-info" aria-hidden="true"></i>  Item Info</a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    <div class='text-center'>{!! $cart_items->render() !!}</div>
</div>
</div>
</section>
@endsection