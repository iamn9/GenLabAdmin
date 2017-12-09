@extends('adminlte::page')
@section('title','Index')
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>{!!$title!!}</h1>
    @include('search')
</div>
<div class="box-body">
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th>Borrower</th>
            <th>Cart ID</th>
            <th>Completed at</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach($transactions as $transaction) 
            <tr id='{!!$transaction->id!!}'>
                <td>Borrower Name</td>
                <td>{!!$transaction->cart_id!!}</td>
                <td>{!!date('F j, Y g:i A', strtotime($transaction->completed_at))!!}</td>
                <td>
                    <a data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger xs' data-link = "/transaction/{!!$transaction->id!!}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    <a href =  '#'  class = 'viewShow btn btn-primary xs'><i class="fa fa-info" aria-hidden="true"></i></a>
                    <a class = 'viewEdit btn btn-warning xs' href = '/transaction/{!!$transaction->id!!}/undo_complete'><i class="fa fa-undo" aria-hidden="true"></i>  Undo</a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    <div class='text-center'>{!! $transactions->render() !!}</div>
</div>
</div>
@endsection