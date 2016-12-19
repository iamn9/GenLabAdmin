@extends('adminlte::page')
@section('title','Index')
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>Cart Index</h1>
    <form method = 'GET'>
        <div class="input-group" >
            <input type="text" name="search" class="form-control pull-right" placeholder="Search">
            <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
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
                <td>{!!$cart->status!!}</td>
                <td>
                    <a href = '/cart' data-link = '/cart/{!!$cart->id!!}/delete' class='delete btn btn-danger btn-xs'><i class = 'material-icons'>delete</i></a>
                    <a href = '#' class = 'viewEdit btn btn-primary btn-xs' data-link = '/cart/{!!$cart->id!!}/edit'><i class = 'material-icons'>edit</i></a>
                    <a href = '#' class = 'viewShow btn btn-warning btn-xs' data-link = '/cart/{!!$cart->id!!}'><i class = 'material-icons'>info</i></a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    <div class='text-center'>{!! $carts->render() !!}</div>
</div>
</div>
@endsection