@extends('scaffold-interface.layouts.app')
@section('title','Show')
@section('content')
<style>
    .dropdown{
        background-color: green;
        color: white;
    }
</style>
<section class='content'>
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
                    <b><i>borrower: </i></b>
                </td>
                <td>{!!$cart->borrower_id!!} : {!!\Helper::student_name($cart->borrower_id);!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>status: </i></b>
                </td>
                <td>{!!$cart->status!!}</td>
            </tr>
            <tr>
                 <td><b><i>subject: </i></b>
                 <td>{!!$cart->subject!!}</td>
            </tr>
            <tr>
                <td><b><i>group members: </i></b>
                <td>
                @foreach($groupmembers as $member)
                    <li>{!!$member->user_id!!} : {!!\Helper::student_name($member->user_id);!!}</li>
                @endforeach
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="box-body">
        <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
            <thead>
                <th>item_id</th>
                <th>qty</th>
                <th>status</th>
            </thead>
            <tbody>
                @foreach($cart_items as $cart_item) 
                <tr>
                    <td>{!!$cart_item->item_id!!}</td>
                    <td>{!!$cart_item->qty!!}</td>
                    <td>{!!\Helper::cartItemStatus($cart_item->status)!!}</td>
                </tr>
                @endforeach 
            </tbody>
        </table>
</div>
</div>
</section>
@endsection