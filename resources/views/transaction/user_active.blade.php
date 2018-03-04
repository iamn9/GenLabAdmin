@extends('adminlte::page_user')
@section('title','GLS | '.$title)
@section('content')

<?php use App\Http\Controllers\TransactionController;?>

<div class="box box-primary">
<div class="box-header">
    <h1>Active Transactions</h1>    
</div>
<div class="box-body">        
    <table class = "dataTable table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
			<th>Cart ID</th>
			<th>Transaction ID</th>			
			<th>Item Count</th>
			<th>Date Submitted</th>
			<th>Status</th>
            <th>Actions</th>
        </thead>
        <tbody>
			@if(count($carts) > 0)
				@foreach($carts as $cart) 
					<tr id='{!!$cart->trans_id!!}'>
						<td>{!!$cart->cart_id!!}</td>
						<td>{!!$cart->trans_id!!}</td>
						<td>{!!$cart->getSize()!!}</td>
						<td>{!!date('F j, Y g:i A', strtotime($cart->submitted_at))!!}</td>
						<td>
							<strong>
								@if($cart->status == "Completed")
									<font color="green">{!!$cart->status!!}</font>
								@elseif($cart->status == "Released")
									<font color="blue">{!!$cart->status!!}</font>
								@elseif($cart->status == "Prepared")
									<font color="orange">{!!$cart->status!!}</font>
								@elseif($cart->status == "Pending")
									<font color="red">{!!$cart->status!!}</font>
								@else
									<font color="grey">{!!$cart->status!!}</font>
								@endif
							</strong>
						</td>
						<td>
                    		<a data-toggle="tooltip" title="View Receipt" class = 'btn btn-success btn-sm' href = '/transaction/{{$cart->trans_id}}/show'>INFO</a>
                		</td>
					</tr>
				@endforeach
			@else
				<tr><td align=center colspan=6>No record found!</td></tr>
			@endif
        </tbody>
    </table>
    <div class='text-center'>{!! $carts->render() !!}</div>
</div>
</div>
@endsection