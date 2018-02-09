@extends('adminlte::page')
@section('title','GLS | '.$title)
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>{{$title}}</h1>
    @include('search')
</div>
<div class="box-body">
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
			<th style="width: 60px">ID</th>
			<th style="width: 80px">Cart ID</th>
			<th style="width: 130px">Borrower ID</th>
			<th style="width: 280px">Borrower Name</th>
            <th>Date submitted</th>
            <th>Status</th>            
            <th>Actions</th>
        </thead>
        <tbody>
			@if(count($transactions) > 0)
				@foreach($transactions as $transaction) 
				<tr id='{!!$transaction->trans_id!!}'>
					<td>{!!$transaction->trans_id!!}</td>        
					<td>{!!$transaction->cart_id!!}</td>        
					<td>{!!$transaction->borrower_id!!}</td>        
					<td>{!!$transaction->getOwner()!!}</td>
					<td>
						@if($transaction->submitted_at != NULL)
							{!!date('F j, Y g:i A', strtotime($transaction->submitted_at))!!}
						@endif                
					</td>
					<td>
						<strong>
							@if($transaction->status == "Completed")
								<font color="green">{!!$transaction->status!!}</font>
							@elseif($transaction->status == "Released")
								<font color="blue">{!!$transaction->status!!}</font>
							@elseif($transaction->status == "Prepared")
								<font color="orange">{!!$transaction->status!!}</font>
							@elseif($transaction->status == "Pending")
								<font color="red">{!!$transaction->status!!}</font>
							@else
								<font color="grey">{!!$transaction->status!!}</font>
							@endif
						</strong>
					</td>
					<td>
						<a data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger xs' data-link = "/transaction/{!!$transaction->trans_id!!}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
						<a href = '/transaction/{!!$transaction->trans_id!!}/edit' class = 'edit btn btn-primary xs'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
						<a href =  '/transaction/{!!$transaction->trans_id!!}/show' class = 'viewShow btn btn-warning xs'><i class="fa fa-info" aria-hidden="true"></i> </a>
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