@extends('adminlte::page_user')
@section('title','Index')
@section('content')

<?php use App\Http\Controllers\AccountabilityController; ?>

<div class="box box-primary">
<div class="box-header">
    <h1>{{$title}}</h1>
    @include('search')
</div>
<div class="box-body">    
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>  
		<thead>
			<tr>
				<th>Quantity</th>
				<th>Item</th>           
				<th>Date borrowed</th>
				<th>Elapsed time</th>
				<th>Total fee</th>
				<th></th>
			</tr>                
		</thead>
		<tbody>
			@if(count($accountabilities) > 0)
				 @foreach($accountabilities as $accountability) 
				<tr id='{!!$accountability->id!!}'>
					<td><?php echo AccountabilityController::get_qty($accountability->transaction_id); ?></td>
					<td><?php echo AccountabilityController::get_item_name($accountability->item_id); ?></td>
					<td> {!!date('F j, Y g:i A', strtotime($accountability->date_borrowed))!!}</td>  
					<td><?php echo AccountabilityController::get_elapsed_time($accountability->date_borrowed); ?></td>
					<td><?php echo AccountabilityController::get_amount_payable($accountability->date_borrowed, $accountability->item_id); ?></td>								
					<td>	<a class = 'viewShow btn btn-primary btn-danger btn-xs' href =  '/accountability/{!!$accountability->id!!}/user_show'><i class="fa fa-info" aria-hidden="true"></i>  Info</a></td>
				</tr>
				@endforeach 
			@else
				<tr>										
					<td align=center colspan=6>No record found</td>										
				</tr>
			@endif        
		</tbody>
    </table>
    <div class='text-center'>{!! $accountabilities->render() !!}</div>
</div>
</div>
@endsection