@extends('adminlte::page')
@section('title','Index')
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
			@if(count($transactions) > 0)
				@foreach($transactions as $transaction) 
				<tr id='{!!$transaction->id!!}'>
					<td>{!!$transaction->id!!}</td>
					<td><?php echo TransactionController::get_borrower_name($transaction->id); ?></td>  
					<td>{!!$transaction->cart_id!!}</td>
					<td>{!!date('F j, Y g:i A', strtotime($transaction->prepared_at))!!}</td>
					<td>
						<a data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger xs' data-link = "/transaction/{!!$transaction->id!!}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
						<a href =  '/transaction/{!!$transaction->id!!}/show'  class = 'viewShow btn btn-primary xs'><i class="fa fa-info" aria-hidden="true"></i></a>
						<a class = 'viewEdit btn btn-success xs' href = '/transaction/{!!$transaction->id!!}/release'><i class="fa fa-check" aria-hidden="true"></i>  Release</a>
						<a class = 'viewEdit btn btn-warning xs' href = '/transaction/{!!$transaction->id!!}/undo_prepare'><i class="fa fa-undo" aria-hidden="true"></i>  Undo</a>
					</td>
				</tr>
				@endforeach 
			@else
				<tr>										
					<td align=center colspan=5>No record found!</td>										
				</tr>
			@endif
        </tbody>
    </table>
    <div class='text-center'>{!! $transactions->render() !!}</div>
</div>
</div>
@endsection