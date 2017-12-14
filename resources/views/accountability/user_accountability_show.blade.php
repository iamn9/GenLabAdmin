@extends('adminlte::page_user')
@section('title','Show')
@section('content')

<?php use App\Http\Controllers\AccountabilityController; ?>

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
			@foreach($user as $curr_user)
            <b>Name: </b>{!!$curr_user->name!!} <br>
            <b>Email: </b>{!!$curr_user->email!!}</b><br>
            <b>Student Number: </b>{!!$curr_user->id_no!!}<br>
			@endforeach
          </address>
        </div>
        <!-- /.col -->

        
        <div class="col-sm-4 invoice-col">
        <strong>Transaction Details</strong><br>
          <address>
          @foreach($carts as $cart)
            @if($cart->status == "Completed")
                <b>Submitted: </b>{!!date('F j, Y g:i A', strtotime($cart->submitted_at))!!}<br>                
                <b>Released: </b>{!!date('F j, Y g:i A', strtotime($cart->released_at))!!}<br>
				<b>Completed: </b>{!!date('F j, Y g:i A', strtotime($cart->completed_at))!!}<br>
            @else
                <b>Submitted: </b>{!!date('F j, Y g:i A', strtotime($cart->submitted_at))!!}<br>
                <b>Status: </b>{!!$cart->status!!}<br>
            @endif          			 
          </address>
		  @endforeach
        </div>
        <!-- /.col -->

        <div class="col-sm-4 invoice-col">
		@foreach($carts as $cart)
          <b>Transaction #:</b> {!!$cart->trans_id!!} <br>
          <b>Cart ID:</b> {!!$cart->cart_id!!}<br>
          <b>Processed by:</b> ----<br>
		 @endforeach
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
			  <th>Total fee</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cart_items as $cart_item)
            <tr>
              <td><?php echo AccountabilityController::get_qty($cart_item->transaction_id); ?></td>
              <td>{!!$cart_item->item_id!!}</td>
              <td><?php echo AccountabilityController::get_item_name($cart_item->item_id); ?></td>
              <td><?php echo AccountabilityController::get_description($cart_item->item_id)?></td>
			  <td>				
					<?php 
						$amount_payable = AccountabilityController::get_amount_payable($cart_item->date_borrowed, $cart_item->item_id);
						echo $amount_payable;?>@if(is_float($amount_payable) == true).00
						@endif
			  </td>
            </tr>
            @endforeach
            </tbody>
          </table>
                    
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