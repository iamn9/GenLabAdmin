@extends('adminlte::page')
@section('title','GLS | '.$title)
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>{!!$title!!}</h1>
    
</div>
<div class="box-body">
    <table class = "dataTable table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th style="width: 60px">ID</th>
            <th style="width: 80px">Cart ID</th>
            <th style="width: 280px">Borrower Name</th>
            <th>Date released</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @if(count($transactions) > 0)
                @foreach($transactions as $transaction) 
                <tr id='{!!$transaction->id!!}'>
                    <td>{!!$transaction->id!!}</td>  
                    <td>{!!$transaction->cart_id!!}</td>       
                    <td>{!!$transaction->getOwner()!!}</td>  
                    <td>{!!date('F j, Y g:i A', strtotime($transaction->released_at))!!}</td>
                    <td>
                        <a data-toggle="tooltip" title="Delete Transaction" data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger xs' data-link = "/transaction/{!!$transaction->id!!}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        <a data-toggle="tooltip" title="View Receipt" class = 'viewShow btn btn-primary xs' href = '/transaction/{!!$transaction->id!!}'><i class="fa fa-info" aria-hidden="true"></i></a>
                        <a data-toggle="tooltip" title="All items were returned in this transaction." class = 'viewEdit btn btn-success xs' href= '/transaction/{!!$transaction->id!!}/confirm_complete'><i class="fa fa-check" aria-hidden="true"></i>  Complete</a>
                        <a data-toggle="tooltip" title="This was not yet released to the user." class = 'viewEdit btn btn-warning xs' href = '/transaction/{!!$transaction->id!!}/undo_release'><i class="fa fa-undo" aria-hidden="true"></i>  Undo</a>
                    </td>
                </tr>
                @endforeach
            @else
				<tr>										
					<td align=center colspan=5>No record found!</td>										
				</tr>
			@endif
        </tbody>
    </table>
    <div class='text-center'>{!! $transactions->render() !!}</div>
</div>
</div>
@endsection