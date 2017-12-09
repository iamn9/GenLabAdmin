@extends('adminlte::page')
@section('title','GLS | '.$title)
@section('content')

<?php use App\Http\Controllers\TransactionController;?>

<div class="box box-primary">
<div class="box-header">
    <h1>{!!$title!!}</h1>
    @include('search')
</div>
<div class="box-body">
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
			<th>Transaction ID</th>
            <th>Borrower</th>
            <th>Cart ID</th>
            <th>Date prepared</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach($transactions as $transaction) 
            <tr id='{!!$transaction->id!!}'>
                <td>{!!$transaction->getOwner()!!}</td>
                <td>{!!$transaction->cart_id!!}</td>
                <td>{!!date('F j, Y g:i A', strtotime($transaction->prepared_at))!!}</td>
                <td>
                    <a data-toggle="tooltip" title="Delete Transaction" data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger xs' data-link = "/transaction/{!!$transaction->id!!}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    <a data-toggle="tooltip" title="View Receipt" class = 'viewShow btn btn-primary xs' href = '/transaction/{!!$transaction->id!!}'><i class="fa fa-info" aria-hidden="true"></i></a>
                    <a data-toggle="tooltip" title="Release the items to the borrower." class = 'viewEdit btn btn-success xs' href = '/transaction/{!!$transaction->id!!}/release'><i class="fa fa-check" aria-hidden="true"></i>  Release</a>
                    <a data-toggle="tooltip" title="The items are not yet prepared." class = 'viewEdit btn btn-warning xs' href = '/transaction/{!!$transaction->id!!}/undo_prepare'><i class="fa fa-undo" aria-hidden="true"></i>  Undo</a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    <div class='text-center'>{!! $transactions->render() !!}</div>
</div>
</div>
@endsection