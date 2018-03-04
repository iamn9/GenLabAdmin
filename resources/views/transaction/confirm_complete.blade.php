@extends('adminlte::page')
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
      <b>Transaction #:</b> {!!$cart->trans_id!!} <br>
      <b>Cart ID:</b> {!!$cart->cart_id!!}<br>
      <b>Status:</b> {!!$cart->status!!}<br>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Qty</th>
            <th>Name</th>
            <th>Brand</th>
            <th>Description</th>
            <th>Fee</th>
          </tr>
        </thead>
        <tbody>
          @foreach($cart_items as $cart_item)
          <tr>
            <td>{!!$cart_item->qty!!}</td>
            <td>{!!$cart_item->getItemName()!!}</td>
            <td>{!!$cart_item->getItemBrand()!!}</td>
            <td>{!!$cart_item->getItemDescription()!!}</td>
            <td>{!!$cart_item->getFee()!!}</td>
          </tr>
          @endforeach
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td align="right"><b>TOTAL FEE</b></td>
            <td><b>{!!$cart->getTotalFee()!!}</b></td>
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
      <form method="POST" action='/accountability/{!!$cart->trans_id!!}/paidCart'>
          <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
          <button data-toggle="tooltip" title="Payment received." class="btn btn-success pull-right no-print" style="margin-right: 5px;" type="submit"><i class="fa fa-check" aria-hidden="true"></i>  Fully Paid</button>
      </form>
      <form method="POST" action="/accountability/{!!$cart->trans_id!!}/recordBill">
          <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
          <button data-toggle="tooltip" title="Will be paid at a later time." class="btn btn-warning pull-right no-print" style="margin-right: 5px;" type="submit" ><i class="fa fa-book" aria-hidden="true"></i>  Record Bill</button>
      </form>
      <button data-toggle="tooltip" title="Print Receipt"  onclick="javascript:window.print();" target="_blank" class="btn btn-primary pull-right no-print" style="margin-right: 5px;"><i class="fa fa-print"></i> Print</button>
      University of The Philippines Visayas - Tacloban College<br>
      Division of Natural Sciences and Mathematics
    </div>
  </div>
</section>

@endsection