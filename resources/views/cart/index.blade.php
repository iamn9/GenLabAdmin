@extends('adminlte::page')
@section('title','Index')
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>Cart Index</h1>
    @include('search')
    <br>
    <form class = 'col s3' method = 'get' action = '{!!url("cart")!!}/create'>
        <button class = 'btn btn-primary' type = 'submit'>Create New cart</button>
    </form>
</div>
<div class="box-body">
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th>borrower_id</th>
            <th>status</th>
            <th>actions</th>
        </thead>
        <tbody>
            @foreach($carts as $cart) 
            <tr>
                <td>{!!$cart->borrower_id!!}</td>
                <td>
                    @if($cart->status == "Draft")
                        <span class="label label-info">
                    @elseif($cart->status == "Pending")
                        <span class="label label-danger">
                    @elseif($cart->status == "Prepared")
                        <span class="label label-warning">
                    @elseif($cart->status == "Released")
                        <span class="label label-primary">
                    @elseif($cart->status == "Completed")
                        <span class="label label-success">
                    @else
                        <span class="label label-info">
                    @endif
                {!!$cart->status!!}</span></td>
                <td>
                    <a href = '/cart' data-link = '/cart/{!!$cart->id!!}/delete' class='delete btn btn-danger btn-xs'><i class="fa fa-trash-o" aria-hidden="true"></i>  Delete</a>
                    <a href = '#' class = 'viewEdit btn btn-primary btn-xs' data-link = '/cart/{!!$cart->id!!}/edit'><i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Edit</a>
                    <a href = '#' class = 'viewShow btn btn-info btn-xs' data-link = '/cart/{!!$cart->id!!}'><i class="fa fa-info" aria-hidden="true"></i>  Info</a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    <div class='text-center'>{!! $carts->render() !!}</div>
</div>
</div>
@endsection