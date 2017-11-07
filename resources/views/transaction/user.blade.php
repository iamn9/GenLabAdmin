@extends('adminlte::page')
@section('title','Index')
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>{!!$title!!}</h1>
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
            <th>released_at</th>
            <th>completed_at</th>
            <th>actions</th>
        </thead>
        <tbody>
            @foreach($transactions as $transaction) 
            <tr>
                <td><a href="#">{!!$transaction->cart_id!!}</a></td>
                <td> {!!date('F d, Y', strtotime($transaction->submitted_at))!!} {!!Carbon\Carbon::parse($transaction->submitted_at)->format('g:i A')!!}
                </td>
                <td> {!!date('F d, Y', strtotime($transaction->released_at))!!} {!!Carbon\Carbon::parse($transaction->released_at)->format('g:i A')!!}
                </td>
                <td><!--{!!$transaction->completed_at!!} -->{!!date('F d, Y', strtotime($transaction->completed_at))!!} {!!Carbon\Carbon::parse($transaction->completed_at)->format('g:i A')!!}
                </td>
                <td>
                    <a href = '#' class = 'viewShow btn btn-warning btn-xs' data-link = '/transaction/{!!$transaction->id!!}'><i class="fa fa-info" aria-hidden="true"></i>  Info</a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    <div class='text-center'>{!! $transactions->render() !!}</div>
</div>
</div>
@endsection