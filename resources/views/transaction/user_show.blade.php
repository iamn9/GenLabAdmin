@extends('adminlte::page_user')
@section('title','Show')
@section('content')

<?php use App\Http\Controllers\TransactionController; ?>

<div class="box box-primary no-print">
<div class="box-header">
    <h1><div class="center">{!!$title!!}</div></h1>

    <br>
</div>
</div>
<section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-flask"></i> GenLab System
            <small class="pull-right">
              {!!date('F d, Y', strtotime($date))!!} 
            </small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        
        <div class="col-sm-4 invoice-col">
          <address>		  
            <strong>Borrower Details</strong><br>		
				<b>Name:  </b>{!!$user->name!!}<br>
				<b>Email:  </b>{!!$user->email!!}<br>
				<b>Student Number:  </b>{!!$user->id_no!!}<br>
          </address>
        </div>
        <!-- /.col -->

        
        <div class="col-sm-4 invoice-col">
        <strong>Transaction Details</strong><br>
          <address>
          @foreach($carts as $cart)
            @if($cart->status == "Completed")
                <b>Submitted: </b>{!!date('F j, Y g:i A', strtotime($cart->submitted_at))!!}<br>
                <b>Prepared: </b>{!!date('F j, Y g:i A', strtotime($cart->prepared_at))!!}<br>
                <b>Released: </b>{!!date('F j, Y g:i A', strtotime($cart->released_at))!!}<br>
            @else
                <b>Submitted: </b>{!!date('F j, Y g:i A', strtotime($cart->submitted_at))!!}<br>
                <b>Status: </b>{!!$cart->status!!}
            @endif
          @endforeach
          </address>
        </div>
        <!-- /.col -->

        <div class="col-sm-4 invoice-col">
          <b>Transaction #:</b> {!!$transaction_id!!} <br>
          <b>Cart ID:</b> {!!$cart->cart_id!!}<br>
          <b>Processed by:</b> ---<br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Qty</th>
              <th>Item</th>
              <th>Name</th>
              <th>Description</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cart_items as $cart_item)
			  <td><?php echo TransactionController::get_qty($transaction_id); ?></td>
              <td><?php echo TransactionController::get_item_id($transaction_id); ?></td>
              <td><?php echo TransactionController::get_item_name($transaction_id); ?></td>
              <td><?php echo TransactionController::get_description($transaction_id)?></td>
			  @if($cart_item->date_returned != null)
				<td>{!!$cart_item->total_fee!!}</td>
			  @else
				<td>
					<?php 
						$amount_payable = TransactionController::get_amount_payable($cart_item->date_borrowed, $cart_item->item_id);
						echo $amount_payable;?>@if(is_float($amount_payable) == true).00
						@endif
				</td>
			  @endif
            </tr>
            @endforeach
            </tbody>
          </table>
          <hr>
          @if ($cart->remarks != "") 
          <b>Remarks: </b> {!!$cart->remarks!!}<br><br> 
          @endif
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


      <!-- this row will not appear when printing -->
      <div class="row">
        <div class="col-xs-12">
            <button onclick="javascript:window.print();" target="_blank" class="btn btn-primary pull-right no-print" style="margin-right: 5px;"><i class="fa fa-print"></i> Print</button>
            University of The Philippines Visayas - Tacloban College<br>
            Division of Natural Sciences and Mathematics
        </div>
      </div>
    </section>
@endsection