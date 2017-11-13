@extends('adminlte::page_user')
@section('title','Show')
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>Show cart</h1>
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
        </tbody>
    </table>
</div>
<div class="box-body">
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th>item_id</th>
            <th>name</th>
            <th>qty</th>
        </thead>
        <tbody>
            @foreach($cart_items as $cart_item) 
            <tr id='{!!$cart_item->id!!}'>
                <td>{!!$cart_item->item_id!!}</td>
                <td>{!!$cart_item->name!!}</td>
                <td>{!!$cart_item->qty!!}</td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    <div class='text-center'>{!! $cart_items->render() !!}</div>
</div>
</div>
@endsection