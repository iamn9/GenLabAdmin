@extends('adminlte::page')
@section('title','Index')
@section('content')

<?php use App\Http\Controllers\AccountabilityController; ?>

<div class="box box-primary">
<div class="box-header">
    <h1>{!!$title!!}</h1>
    @include('search')
</div>
<div class="box-body">
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
           <th>No.</th>			
            <th>Borrower ID</th>
            <th>Name</th>
			<th>Item</th>
            <th>Date borrowed</th>			
            <th>Elapsed time</th>            
            <th>Amount payable</th>
			<th></th>
        </thead>
        <tbody>
			@if(count($accountabilities) > 0)
				@foreach($accountabilities as $accountability) 
				<tr id='{!!$accountability->id!!}'>
					<td>{!!$accountability->id!!}</td>				
					<td>{!!$accountability->borrower_id!!}</td>
					<td>{!!$accountability->borrower_name!!}</td>
					<td><?php echo AccountabilityController::get_item_name($accountability->item_id); ?></td>                								
					<td> {!!date('F j, Y g:i A', strtotime($accountability->date_borrowed))!!}</td>                				
					<td><?php echo AccountabilityController::get_elapsed_time($accountability->date_borrowed); ?></td>
					<td>
							<?php 
								$amount_payable = AccountabilityController::get_amount_payable($accountability->date_borrowed, $accountability->item_id);
								echo $amount_payable;?>@if(is_float($amount_payable) == true).00
							@endif
					</td>	
					<td>					 
						<a class = 'viewShow btn btn-primary btn-danger btn-xs' href =  '/accountability/{!!$accountability->id!!}/show'><i class="fa fa-info" aria-hidden="true"></i>  Info</a>
					</td>
				</tr>
				@endforeach 
			@else
				<tr>										
					<td align=center colspan=8>No record found!</td>										
				</tr>
			@endif
        </tbody>
    </table>
    <div class='text-center'>{!! $accountabilities->render() !!}</div>
</div>
</div>
@endsection