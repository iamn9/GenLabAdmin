@extends('adminlte::page')
@section('title','GLS | '.$title)
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>{{$title}}</h1>
</div>
<div class="box-body">
    <table class = "dataTable table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th>Borrower</th>
            <th>Trans ID</th>
            <th style="width: 80px">Cart ID</th>
            <th>Manage Cart</th>
            <th>Status</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach($transactions as $transaction) 
                <tr id='{!!$transaction->id!!}'>
                    <td>{!!$transaction->getOwner()!!}</td>
                    <td>{!!$transaction->id!!}</td>  
                    <td>{!!$transaction->cart_id!!}</td>         
                    <td>
                        <a data-toggle="tooltip" title="View Receipt" class = 'viewShow btn btn-primary btn-sm' href = '/transaction/{!!$transaction->id!!}'><i class="fa fa-book" aria-hidden="true"></i>  Show Receipt</a>
                        <a data-toggle="tooltip" title="Show cart information and its items" class = 'viewShow btn btn-info btn-sm' href = '/cart/{!!$transaction->cart_id!!}'><i class="fa fa-info" aria-hidden="true"></i>  Manage Cart</a>
                    </td>
                    <td>{!!$transaction->getCartStatus()!!}</td>
                    <td>
                        @if($transaction->getCartStatus() == "Pending")
                            <a data-toggle="tooltip" title="Delete user request." href = '#' data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-sm' data-link = "/cart/{!!$transaction->cart_id!!}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i>  Delete Cart</a>
                            <a data-toggle="tooltip" title="Return borrow request to the user." class = 'viewEdit btn btn-warning btn-sm' href = '/transaction/{!!$transaction->id!!}/undo_submission'><i class="fa fa-undo" aria-hidden="true"></i>  Return to User</a>
                            <a data-toggle="tooltip" title="The items are ready." class = 'viewEdit btn btn-success btn-sm' href = '/transaction/{!!$transaction->id!!}/prepare'><i class="fa fa-check" aria-hidden="true"></i>  Prepared</a>
                        @elseif($transaction->getCartStatus() == "Prepared")
                            <a data-toggle="tooltip" title="Delete user request." href = '#' data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-sm' data-link = "/cart/{!!$transaction->cart_id!!}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i>  Delete Cart</a>
                            <a data-toggle="tooltip" title="The items are not yet prepared." class = 'viewEdit btn btn-warning btn-sm' href = '/transaction/{!!$transaction->id!!}/undo_prepare'><i class="fa fa-undo" aria-hidden="true"></i>  Not yet prepared</a>
                            <a data-toggle="tooltip" title="The items are released." class = 'viewEdit btn btn-success btn-sm' href = '/transaction/{!!$transaction->id!!}/release'><i class="fa fa-check" aria-hidden="true"></i>  Release</a>
                        @elseif($transaction->getCartStatus() == "Released")
                            <a data-toggle="tooltip" title="The items are not yet released." class = 'viewEdit btn btn-warning btn-sm' href = '/transaction/{!!$transaction->id!!}/undo_release'><i class="fa fa-undo" aria-hidden="true"></i>  Not yet released</a>
                            <a data-toggle="tooltip" title="The items are completed." class = 'viewEdit btn btn-success btn-sm' href = '/transaction/{!!$transaction->id!!}/confirm_complete'><i class="fa fa-check" aria-hidden="true"></i>  Complete</a>
                        @elseif($transaction->getCartStatus() == "Completed")
                            <a data-toggle="tooltip" title="Not yet completely returned." class = 'viewEdit btn btn-warning btn-sm' href = '/transaction/{!!$transaction->id!!}/undo_complete'><i class="fa fa-undo" aria-hidden="true"></i>  Undo</a>
                        @endif
                    </td>
                </tr>
            @endforeach            
        </tbody>
    </table>
</div>
</div>
@endsection