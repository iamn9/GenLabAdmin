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
			<th style="width: 30px">ID</th>				
			<th style="width: 30px">TransID</th>
            <th>Name</th>
			<th style="width: 90px">UserID</th>
			<th style="width: 30px">ItemID</th>
            <th>Date Incurred</th>						        
            <th>Amount</th>
			<th>Actions</th>
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
					<td>{!!$accountability->amount!!}</td>				
					<td>					 
						<a data-toggle="tooltip" title="Remove Accountability" class = 'delete btn btn-danger xs' data-link = "/accountability/{!!$accountability->id!!}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
						<a data-toggle="tooltip" title="Item paid" class = 'update btn btn-success xs' href = '/accountability/{!!$accountability->id!!}/payItem'><i class="fa fa-check" aria-hidden="true"></i>  Paid</a>
					</td>
				</tr>
			@endforeach
        </tbody>
    </table>
</div>
</div>
@endsection