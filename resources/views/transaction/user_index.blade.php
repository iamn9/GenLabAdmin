@extends('adminlte::page_user')
@section('title','GLS | '.$title)
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>{!!$title!!}</h1>
</div>
<div class="box-body">
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th>Cart ID</th>
            <th>Submitted at</th>
            <th>Prepared at</th>
            <th>Released at</th>
            <th>Completed at</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach($transactions as $transaction) 
            <tr id='{!!$transaction->id!!}'>
                <td>{!!$transaction->cart_id!!}</td>
                <td>
                    @if($transaction->submitted_at != NULL)
                        {!!date('F j, Y g:i A', strtotime($transaction->submitted_at))!!}
                    @endif
                <td>
                    @if($transaction->prepared_at != NULL)
                        {!!date('F j, Y g:i A', strtotime($transaction->prepared_at))!!}
                    @endif
                <td>
                    @if($transaction->released_at != NULL)
                        {!!date('F j, Y g:i A', strtotime($transaction->released_at))!!}
                    @endif
                </td>
                <td>
                    @if($transaction->completed_at != NULL)
                        {!!date('F j, Y g:i A', strtotime($transaction->completed_at))!!}
                    @endif
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