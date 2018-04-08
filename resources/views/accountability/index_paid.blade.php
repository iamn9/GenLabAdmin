@extends('adminlte::page')
@section('title','GLS | '.$title)
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>{{$title}}</h1>
    
</div>
<div class="box-body">    
    <table class = "dataTable table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>	
			<th style="width: 30px">TransID</th>
            <th>Name</th>
			<th>Item</th>
			<th style="width: 30px">QTY</th>		
            <th>Date Paid</th>            
            <th>Amount</th>
			<th>Actions</th>
        </thead>
        <tbody>
			@foreach($accountabilities as $accountability) 
				<tr id='{!!$accountability->id!!}'>
					<td><a href="/transaction/{!!$accountability->trans_id!!}">{!!$accountability->trans_id!!}</a></td>								
					<td>{!!$accountability->getOwner()!!}</td>
					<td><a href="/item/{!!$accountability->item_id!!}">{!!$accountability->getItemName()!!}</a></td>
					<td>{!!$accountability->qty!!}</td>			
					<td>{!!date('F j, Y g:i A', strtotime($accountability->date_paid))!!}</td>				
					<td>{!!$accountability->amount!!}</td>				
					<td>					 
						<a data-toggle="tooltip" title="Undo payment." class = 'edit btn btn-warning btn-xs' data-link = '/accountability/{!!$accountability->id!!}/undo_payment'><i class="fa fa-undo" aria-hidden="true"></i>  Undo</a>
					</td>
				</tr>
			@endforeach
        </tbody>
    </table>
</div>
</div>
@endsection