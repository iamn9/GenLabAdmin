@extends('adminlte::page_user')
@section('title','GLS | '.$title)
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>{!!$title!!}</h1>
</div>
<div class="box-body">
    <table class = "dataTable table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th>TransID</th>
            <th>CartID</th>
            <th>Completed At</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach($transactions as $transaction) 
                <tr id='{!!$transaction->id!!}'>
                    <td><a href="/transaction/{!!$transaction->trans_id!!}">{!!$transaction->trans_id!!}</a></td>
                    <td><a href="/cart/{!!$transaction->cart_id!!}">{!!$transaction->cart_id!!}</a></td>
                    <td>{!!date('F d, Y g:i A', strtotime($transaction->completed_at))!!} </td>
                    <td>
                        <a data-toggle="tooltip" title="View Receipt" class = 'btn btn-success btn-sm' href = '/transaction/{{$transaction->trans_id}}/show'>INFO</a>
                    </td>
                </tr>
            @endforeach 
        </tbody>
    </table>
</div>
</div>
@endsection