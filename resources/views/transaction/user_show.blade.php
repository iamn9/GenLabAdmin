@extends('adminlte::page_user')
@section('title','GLS | '.$title)
@section('content')

<section class="invoice">
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <i class="fa fa-flask"></i> GenLab System
        <small class="pull-right">
          {!!date('F d, Y', strtotime($date))!!} 
        </small>
      </h2>
    </div>
  </div>

  <div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
      <address>
        <strong>Borrower Details</strong><br>
        Name:   <b>{!!$user->name!!}</b><br>
        Email:   <b>{!!$user->email!!}</b><br>
        Student Number:   <b>{!!$user->id_no!!}</b><br>
      </address>
    </div>

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

    <div class="col-sm-4 invoice-col">
      <address>
      <b>Transaction #:</b> {!!$cart->trans_id!!}<br>
      <b>Cart ID:</b> {!!$cart->cart_id!!}<br>
      <b>Status:</b> {!!$cart->status!!}<br>
      </address>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Qty</th>
            <th>Item</th>
            <th>Name</th>
            <th>Description</th>
            <th>Payable</th>
          </tr>
        </thead>
        <tbody>
          @foreach($cart_items as $cart_item)
          <tr>
            <td>{!!$cart_item->qty!!}</td>
            <td>{!!$cart_item->item_id!!}</td>
            <td>{!!$cart_item->name!!}</td>
            <td>{!!$cart_item->description!!}</td>
            <td>{!!$cart_item->getPayable()!!}</td>
          </tr>
          @endforeach
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td align="right"><b>TOTAL PAYABLE</b></td>
            <td><b>{!!$cart->getTotalPayable()!!}</b></td>
          </tr>
        </tbody>
      </table>
      <hr>
      @if ($cart->remarks != "") 
      <b>Remarks: </b> {!!$cart->remarks!!}<br><br> 
      @endif
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
        <button data-toggle="tooltip" title="Print Receipt"  onclick="javascript:window.print();" target="_blank" class="btn btn-primary pull-right no-print" style="margin-right: 5px;"><i class="fa fa-print"></i> Print</button>
        University of The Philippines Visayas - Tacloban College<br>
        Division of Natural Sciences and Mathematics
    </div>
  </div>
</section>

@endsection