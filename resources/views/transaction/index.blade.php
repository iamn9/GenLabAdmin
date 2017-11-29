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
            <th>cart_id</th>
            <th>submitted_at</th>
            <th>prepared_at</th>
            <th>released_at</th>
            <th>completed_at</th>
            <th>actions</th>
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
                    <a data-toggle="tooltip" title="Delete Transaction" data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger xs' data-link = "/transaction/{!!$transaction->id!!}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    <a data-toggle="tooltip" title="View Receipt" class = 'viewShow btn btn-primary xs' href = '/transaction/{!!$transaction->id!!}'><i class="fa fa-info" aria-hidden="true"></i> </a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    <div class='text-center'>{!! $transactions->render() !!}</div>
</div>
</div>
@endsection