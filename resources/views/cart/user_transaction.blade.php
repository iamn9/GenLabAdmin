@extends('scaffold-interface.layouts.app')
@section('title','Carts')
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>USER'S CartS</h1>
    <br>
    <form class = 'col s3' method = 'get' action = '{!!url("cart")!!}/create'>
        <button class = 'btn btn-primary' type = 'submit'>Create New cart</button>
    </form>
</div>
<div class="box-body">
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th>id</th>
            <th>status</th>
            <th>actions</th>
        </thead>
        <tbody>
            @foreach($carts as $cart) 
            <tr>
                <td>{!!$cart->id!!}</td>
                <td>
                    @if($cart->status == "Draft")
                        <span class="label label-primary">
                    @elseif($cart->status == "Pending")
                        <span class="label label-danger">
                    @elseif($cart->status == "Disbursed")
                        <span class="label label-warning">
                    @elseif($cart->status == "Completed")
                        <span class="label label-success">
                    @else
                        <span class="label label-info">
                    @endif
                {!!$cart->status!!}</span></td>
                <td>
                    <a href = '#' class = 'viewShow btn btn-warning btn-xs' data-link = '/cart/{!!$cart->id!!}'><i class="fa fa-info" aria-hidden="true"></i>  Info</a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    <div class='text-center'>{!! $carts->render() !!}</div>
</div>
</div>
@endsection