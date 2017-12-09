@extends('adminlte::page')
@section('title','Index')
@section('content')

<?php use App\Http\Controllers\TransactionController;?>

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
			<th>Transaction ID</th>
            <th>Cart ID</th>
			<th>Borrower</th>
            <th>Date submitted</th>
            <th>Status</th>            
            <th></th>
        </thead>
        <tbody>
            @foreach($transactions as $transaction) 
            <tr id='{!!$transaction->id!!}'>
				<td>{!!$transaction->id!!}</td>
                <td>{!!$transaction->cart_id!!}</td>
				<td><?php echo TransactionController::get_borrower_name($transaction->id); ?></td>
                <td>
                    @if($transaction->submitted_at != NULL)
                        {!!date('F j, Y g:i A', strtotime($transaction->submitted_at))!!}
                    @endif                
                </td>
                <td>
                    <?php echo TransactionController::get_cart_status($transaction->id); ?>
                </td>
                <td>
                    <a data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger xs' data-link = "/transaction/{!!$transaction->id!!}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    <a href = '#' class = 'edit btn btn-primary xs' data-link = '/transaction/{!!$transaction->id!!}/edit'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    <a href =  '#' class = 'viewShow btn btn-warning xs'><i class="fa fa-info" aria-hidden="true"></i> </a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    <div class='text-center'>{!! $transactions->render() !!}</div>
</div>
</div>
@endsection