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
			<th style="width: 50px">ID</th>				
			<th style="width: 100px">Trans ID</th>
            <th>Name</th>
			<th>Borrower ID</th>
			<th>Item ID</th>
            <th>Date Incurred</th>						
            <th>Date Paid</th>            
            <th>Amount</th>
        </thead>
        <tbody>
			@foreach($accountabilities as $accountability) 
				<tr id='{!!$accountability->id!!}'>
					<td>{!!$accountability->id!!}</td>
					<td>{!!$accountability->trans_id!!}</td>								
					<td>{!!$accountability->getOwner()!!}</td>
					<td>{!!$accountability->getOwnerID()!!}</td>
					<td>{!!$accountability->item_id!!}</td>
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