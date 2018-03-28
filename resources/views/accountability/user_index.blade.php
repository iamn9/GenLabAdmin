@extends('adminlte::page_user')
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
			<th>Item Name</th>
			<th>Unreturned QTY</th>
            <th>Date Incurred</th>						
			<th>Date Paid</th>
            <th>Fees</th>
        </thead>
        <tbody>
			@foreach($accountabilities as $accountability) 
				<tr id='{!!$accountability->id!!}'>		
					<td><a href="/transaction/{!!$accountability->trans_id!!}">{!!$accountability->trans_id!!}</a></td>				
					<td><a href="/item/{!!$accountability->item_id!!}">{!!$accountability->getItemName()!!}</a></td>		
					<td>{!!$accountability->qty!!}</td>
					<td>{!!$accountability->date_incurred!!}</td>
					<td>{!!$accountability->date_paid!!}</td>							
					<td>{!!$accountability->amount!!}</td>				
				</tr>
			@endforeach
        </tbody>
    </table>
</div>
</div>
@endsection