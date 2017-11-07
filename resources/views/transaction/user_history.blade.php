@extends('adminlte::page_user')
@section('title','Transaction History')
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>{!!$title!!}</h1>
</div>
<div class="box-body">
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th>Cart ID</th>
            <th>Completed at</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach($transactions as $transaction) 
            <tr>
                <td>{!!$transaction->cart_id!!}</td>
                <td>{!!date('F d, Y', strtotime($transaction->completed_at))!!} {!!Carbon\Carbon::parse($transaction->completed_at)->format('g:i A')!!}
                </td>
                <td>
                    <form method = 'GET' action = '/transaction/{{$transaction->cart_id}}/show'>
                        <button class = 'btn btn-success'>INFO</button>
                    </form>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    <div class='text-center'>{!! $transactions->render() !!}</div>
</div>
</div>
@endsection