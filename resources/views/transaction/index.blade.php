@extends('adminlte::page')
@section('title','GLS | '.$title)
@section('content')

<?php use App\Http\Controllers\TransactionController;?>

<div class="box box-primary">
<div class="box-header">
    <h1>{{$title}}</h1>
    @include('search')
</div>
<div class="box-body">
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
			<th>Transaction ID</th>            
			<th>Borrower</th>
			<th>Cart ID</th>
            <th>Date submitted</th>
            <th>Status</th>            
            <th></th>
        </thead>
        <tbody>
			@if(count($transactions) > 0)
				@foreach($transactions as $transaction) 
				<tr id='{!!$transaction->id!!}'>
					<td>{!!$transaction->id!!}</td>                
					<td><?php echo TransactionController::get_borrower_name($transaction->id); ?></td>
					<td>{!!$transaction->cart_id!!}</td>
					<td>
						@if($transaction->submitted_at != NULL)
							{!!date('F j, Y g:i A', strtotime($transaction->submitted_at))!!}
						@endif                
					</td>
					<td>
						<?php $status = TransactionController::get_cart_status($transaction->id); ?>					
						<strong>
							@if($status == "Completed")
								<font color="green">{!!$status!!}</font>
							@elseif($status == "Released")
								<font color="blue">{!!$status!!}</font>
							@elseif($status == "Prepared")
								<font color="orange">{!!$status!!}</font>
							@elseif($status == "Pending")
								<font color="red">{!!$status!!}</font>
							@else
								<font color="grey">{!!$status!!}</font>
							@endif
						</strong>
					</td>
					<td>
						<a data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger xs' data-link = "/transaction/{!!$transaction->id!!}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
						<a href = '/transaction/{!!$transaction->id!!}/edit' class = 'edit btn btn-primary xs'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
						<a href =  '/transaction/{!!$transaction->id!!}/show' class = 'viewShow btn btn-warning xs'><i class="fa fa-info" aria-hidden="true"></i> </a>
					</td>
				</tr>
				@endforeach 
			@else
				<tr>										
					<td align=center colspan=6>No record found!</td>										
				</tr>
			@endif
        </tbody>
    </table>
    <div class='text-center'>{!! $transactions->render() !!}</div>
</div>
</div>
@endsection