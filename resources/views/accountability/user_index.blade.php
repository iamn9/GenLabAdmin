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
			<th style="width: 100px">Trans ID</th>
			<th>Item Name</th>
            <th>Date Incurred</th>						
            <th>Amount</th>
        </thead>
        <tbody>
			@if(count($accountabilities) > 0)
				 @foreach($accountabilities as $accountability) 
				<tr id='{!!$accountability->id!!}'>		
					<td>{!!$accountability->trans_id!!}</td>				
					<td>{!!$accountability->getItemName()!!}</td>		
					<td>{!!$accountability->date_incurred!!}</td>							
					<td>{!!$accountability->amount!!}</td>				
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