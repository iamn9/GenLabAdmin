@extends('scaffold-interface.layouts.app')
@section('title','Index')
@section('content')

<section class="content">
    <h1>
        Cart Index
    </h1>
    <form class = 'col s3' method = 'get' action = '{!!url("cart")!!}/create'>
        <button class = 'btn btn-primary' type = 'submit'>Create New cart</button>
    </form>
    <br>
    <br>
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
                    <a data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-xs' data-link = "/cart/{!!$cart->id!!}/deleteMsg" ><i class = 'material-icons'>delete</i></a>
                    <a href = '#' class = 'viewEdit btn btn-primary btn-xs' data-link = '/cart/{!!$cart->id!!}/edit'><i class = 'material-icons'>edit</i></a>
                    <a href = '#' class = 'viewShow btn btn-warning btn-xs' data-link = '/cart/{!!$cart->id!!}'><i class = 'material-icons'>info</i></a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    {!! $carts->render() !!}

</section>
@endsection