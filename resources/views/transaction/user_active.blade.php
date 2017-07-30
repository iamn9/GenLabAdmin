@extends('scaffold-interface.layouts.app')
@section('title','Index')
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>{!!$title!!}</h1>
</div>
<div class="box-body">
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th>Cart ID</th>
            <th>Submitted at</th>
            <th>Released at</th>
            <th>Status</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach($carts as $cart) 
            <tr>
                
                <td>{!!$cart->cart_id!!}</td>
                <td>{!!\Helper::format_date($cart->submitted_at);!!}</td>
                <td>{!!\Helper::format_date($cart->released_at);!!}</td>
                <td>{!!$cart->status!!}</td>
                <td>
                    <a href = '#' class = 'viewShow btn btn-warning xs' data-link = '/transaction/{!!$cart->trans_id!!}'><i class="fa fa-info" aria-hidden="true"></i> </a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    <div class='text-center'>{!! $carts->render() !!}</div>
</div>
</div>
@endsection