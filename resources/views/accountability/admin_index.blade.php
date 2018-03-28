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
			<th style="width: 30px">ItemID</th>
			<th>QTY</th>
            <th>Date Incurred</th>						
            <th>Date Paid</th>            
            <th>Rental Fee</th>

        </thead>
        <tbody>
			@foreach($accountabilities as $accountability) 
				<tr id='{!!$accountability->id!!}'>
					<td><a href="/transaction/{!!$accountability->trans_id!!}">{!!$accountability->trans_id!!}</a></td>								
					<td>{!!$accountability->getOwner()!!}</td>		
					<td><a href="/item/{!!$accountability->item_id!!}">{!!$accountability->item_id!!}</a></td>
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