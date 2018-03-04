@extends('adminlte::page')
@section('title','GLS | '.$title)
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>{{$title}}</h1>
    <form class = 'col s3' method = 'get' action = '{!!url("cart")!!}/create'>
        <button class = 'btn btn-primary' type = 'submit'><i class="fa fa-plus fa-md" aria-hidden="true"></i>  Create New cart</button>
    </form>
</div>
<div class="box-body">
    <table class = "dataTable table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th style="width: 120px">status</th>
            <th style="width:160px">borrower_id</th>
            <th style="width:170px">Borrower Name</th>
            <th style="width:90px"># of Items</th>
            <th>Remarks</th>
            <th style="width: 200px">actions</th>
        </thead>
        <tbody>
            @foreach($carts as $cart) 
            <tr id='{!!$cart->id!!}'>
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
                <td>{!!$cart->borrower_id!!}</td>
                <td>{!!$cart->getOwner()!!}</td>
                <td>{!!$cart->getSize()!!}</td>
                <td>{!!$cart->remarks!!}</td>
                <td>
                    @if($cart->status != "Completed" && $cart->status != "Released")
                        <a data-toggle="tooltip" title="Delete user request." href = '#' data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-xs' data-link = "/cart/{!!$cart->id!!}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i>  Delete</a>
                        <a data-toggle="tooltip" title="Edit Cart Information." class = 'viewEdit btn btn-primary btn-xs' href = '/cart/{!!$cart->id!!}/edit'><i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Edit</a>
                    @endif
                    <a data-toggle="tooltip" title="Show cart information and its items" class = 'viewShow btn btn-info btn-xs' href = '/cart/{!!$cart->id!!}'><i class="fa fa-info" aria-hidden="true"></i>  Info</a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    <div class='text-center'>{!! $carts->render() !!}</div>
</div>
</div>
@endsection