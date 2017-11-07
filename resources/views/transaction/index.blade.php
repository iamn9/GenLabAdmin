@extends('adminlte::page')
@section('title','Index')
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>Transaction Index</h1>
    @include('search')
</div>
<div class="box-body">
    <form class = 'col s3' method = 'get' action = '{!!url("transaction")!!}/create'>
        <button class = 'btn btn-primary' type = 'submit'>Create New transaction</button>
    </form>
    <br>
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
            <tr>
                <td>{!!$transaction->cart_id!!}</td>
                <td> {!!date('F d, Y', strtotime($transaction->submitted_at))!!} {!!Carbon\Carbon::parse($transaction->submitted_at)->format('g:i A')!!}
                </td>
                <td> {!!date('F d, Y', strtotime($transaction->prepared_at))!!} {!!Carbon\Carbon::parse($transaction->prepared_at)->format('g:i A')!!}
                </td>
                <td> {!!date('F d, Y', strtotime($transaction->released_at))!!} {!!Carbon\Carbon::parse($transaction->released_at)->format('g:i A')!!}
                </td>
                <td> {!!date('F d, Y', strtotime($transaction->completed_at))!!} {!!Carbon\Carbon::parse($transaction->completed_at)->format('g:i A')!!}
                </td>
                <td>
                    <a data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger xs' data-link = "/transaction/{!!$transaction->id!!}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    <a href = '#' class = 'edit btn btn-primary xs' data-link = '/transaction/{!!$transaction->id!!}/edit'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    <a href = '#' class = 'viewShow btn btn-warning xs' data-link = '/transaction/{!!$transaction->id!!}'><i class="fa fa-info" aria-hidden="true"></i> </a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    <div class='text-center'>{!! $transactions->render() !!}</div>
</div>
</div>
@endsection