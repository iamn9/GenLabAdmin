@extends('adminlte::page_user')
@section('title','Index')
@section('content')

<?php use App\Http\Controllers\TransactionController;?>

<div class="box box-primary">
<div class="box-header">
    <h1>Active Transactions</h1>    
</div>
<div class="box-body">        
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
			<th>Cart ID</th>
			<th>Transaction ID</th>            						
			<th>Quantity</th>
			<th>Item</th>
            <th>Date submitted</th>			
			<th>Status</th>
            <th></th>
        </thead>
        <tbody>
			@if(count($carts) > 0)
				@foreach($carts as $cart) 
				<tr id='{!!$cart->id!!}'>
					<td>{!!$cart->id!!}</td>
					<td><?php echo TransactionController::get_transaction_id($cart->id);?></td>                										
					<td><?php echo TransactionController::get_qty(TransactionController::get_transaction_id($cart->id));?>
					</td>
					<td><?php echo TransactionController::get_item_name(TransactionController::get_transaction_id($cart->id))?></td>
					<td><?php 
								$date_released = TransactionController::get_date_released(TransactionController::get_transaction_id($cart->id));
								
								if($date_released != null){
									echo date('F j, Y g:i A', strtotime($date_released));
								}else{
									echo "----";
								}
							?>
					</td>
					<td>
						<?php $status = TransactionController::get_cart_status(TransactionController::get_transaction_id($cart->id)); ?>					
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
						<?php $transaction_id = TransactionController::get_transaction_id($cart->id);?>
						<a class = 'viewShow btn btn-primary btn-warning btn-xs' href = '/transaction/{!!$transaction_id!!}/user_show'><i class="fa fa-info" aria-hidden="true"></i>  Info</a>
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
    <div class='text-center'>{!! $carts->render() !!}</div>
</div>
</div>
@endsection