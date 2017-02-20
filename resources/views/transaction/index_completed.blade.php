@extends('adminlte::page')
@section('title','Index')
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>{!!$title!!}</h1>
    <form method = 'GET'>
        @if($searchWord != "")
            Showing search results for "<b>{{$searchWord}}</b>".
        @endif
        <div class="input-group" >
            <input type="text" name="search" class="form-control pull-right" placeholder="Search" value='{!!$searchWord!!}'>
            <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
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
            <tr>
                <td>Borrower Name</td>
                <td>{!!$transaction->cart_id!!}</td>
                <td>{!!$transaction->completed_at!!}</td>
                <td>
                    <a data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger xs' data-link = "/transaction/{!!$transaction->id!!}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    <a href = '#' class = 'viewShow btn btn-primary xs' data-link = '/transaction/{!!$transaction->id!!}'><i class="fa fa-info" aria-hidden="true"></i></a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    <div class='text-center'>{!! $transactions->render() !!}</div>
</div>
</div>
@endsection