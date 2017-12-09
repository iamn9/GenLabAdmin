@extends('adminlte::page')
@section('title','Show')
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>ADMIN: Show cart_item</h1>
</div>
<div class="box-body">
    <br>
    <form method = 'get' action = '{!!url("cart_item")!!}'>
        <button class = 'btn btn-primary'>cart_item Index</button>
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
                    <b><i>cart_id : </i></b>
                </td>
                <td>{!!$cart_item->cart_id!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>item_id : </i></b>
                </td>
                <td>{!!$cart_item->item_id!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>qty : </i></b>
                </td>
                <td>{!!$cart_item->qty!!}</td>
            </tr>
        </tbody>
    </table>
</div>
</div>
@endsection