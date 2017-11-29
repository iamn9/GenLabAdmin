@extends('adminlte::page')
@section('title','GLS | '.$title)
@section('content')

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
            Name:   <b>{!!$user->name!!}</b><br>
            Email:   <b>{!!$user->email!!}</b><br>
            Student Number:   <b>{!!$user->id_no!!}</b><br>
          </address>
        </div>
        <!-- /.col -->

        
        <div class="col-sm-4 invoice-col">
        <strong>Transaction Details</strong><br>
        <address>
          @foreach($carts as $cart)
            @if($cart->status == "Completed")
                Submitted: {!!date('F j, Y g:i A', strtotime($cart->submitted_at))!!}<br>
                Prepared: {!!date('F j, Y g:i A', strtotime($cart->prepared_at))!!}<br>
                Released: {!!date('F j, Y g:i A', strtotime($cart->released_at))!!}<br>
                Completed: {!!date('F j, Y g:i A', strtotime($cart->completed_at))!!}<br>
            @endif
            @if($cart->status == "Released")
                Submitted: {!!date('F j, Y g:i A', strtotime($cart->submitted_at))!!}<br>
                Prepared: {!!date('F j, Y g:i A', strtotime($cart->prepared_at))!!}<br>
                Released: {!!date('F j, Y g:i A', strtotime($cart->released_at))!!}<br>
            @endif
            @if($cart->status == "Prepared")
                Submitted: {!!date('F j, Y g:i A', strtotime($cart->submitted_at))!!}<br>
                Prepared: {!!date('F j, Y g:i A', strtotime($cart->prepared_at))!!}<br>
            @endif
            @if($cart->status == "Pending")
                Submitted: {!!date('F j, Y g:i A', strtotime($cart->submitted_at))!!}<br>
            @endif
          @endforeach
        </address>
        </div>
        <!-- /.col -->

        <div class="col-sm-4 invoice-col">
          <b>Transaction #:</b> {!!$cart->trans_id!!} <br>
          <b>Cart ID:</b> {!!$cart->cart_id!!}<br>
          <b>Status:</b> {!!$cart->status!!}<br>
          <b>Processed by:</b> {!!$nameAdmin!!}<br>
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
            <tr>
              <td>{!!$cart_item->qty!!}</td>
              <td>{!!$cart_item->item_id!!}</td>
              <td>{!!$cart_item->name!!}</td>
              <td>{!!$cart_item->description!!}</td>
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
</section>
@endsection