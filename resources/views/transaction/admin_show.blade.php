@extends('adminlte::page')
@section('title','GLS | '.$title)
@section('content')

<section class="invoice">
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <i class="fa fa-flask"></i> GenLab System
        <small class="pull-right">
          {!!date('F d, Y g:i A', strtotime($date))!!}
        </small>
      </h2>
    </div>
  </div>

  <div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
      <address>
        <strong>Borrower Details</strong>
        <br> Name:
        <b>{!!$user->name!!}</b>
        <br> Email:
        <b>{!!$user->email!!}</b>
        <br> Student Number:
        <b>{!!$user->id_no!!}</b>
        <br>
      </address>
    </div>

    <div class="col-sm-4 invoice-col">
      <strong>Transaction Details</strong>
      <br>
      <address>
        @if($cart->status == "Completed") Submitted: {!!date('F j, Y g:i A', strtotime($transaction->submitted_at))!!}
        <br> Prepared: {!!date('F j, Y g:i A', strtotime($transaction->prepared_at))!!}
        <br> Released: {!!date('F j, Y g:i A', strtotime($transaction->released_at))!!}
        <br> Completed: {!!date('F j, Y g:i A', strtotime($transaction->completed_at))!!}
        <br> @endif @if($cart->status == "Released") Submitted: {!!date('F j, Y g:i A', strtotime($transaction->submitted_at))!!}
        <br> Prepared: {!!date('F j, Y g:i A', strtotime($transaction->prepared_at))!!}
        <br> Released: {!!date('F j, Y g:i A', strtotime($transaction->released_at))!!}
        <br> @endif @if($cart->status == "Prepared") Submitted: {!!date('F j, Y g:i A', strtotime($transaction->submitted_at))!!}
        <br> Prepared: {!!date('F j, Y g:i A', strtotime($transaction->prepared_at))!!}
        <br> @endif @if($cart->status == "Pending") Submitted: {!!date('F j, Y g:i A', strtotime($transaction->submitted_at))!!}
        <br> @endif
      </address>
    </div>

    <div class="col-sm-4 invoice-col">
      <b>Transaction #:</b> {!!$transaction->id!!}
      <br>
      <b>CartID:</b> {!!$cart->id!!}
      <br>
      <b>Status:</b> {!!$cart->status!!}
      <br>
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
            <th>Fees</th>
          </tr>
        </thead>
        <tbody>
          @foreach($cart_items as $cart_item)
          <tr>
            <td>{!!$cart_item->qty!!}</td>
            <td>{!!$cart_item->getItemName()!!}</td>
            <td>{!!$cart_item->getItemBrand()!!}</td>
            <td>{!!$cart_item->getFee()!!}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-6">
      <p class="lead">Notes:</p>
      <p class="text-muted well well-xs no-shadow" style="margin-top: 10px;">
        @if ($cart->remarks != "") {!!$cart->remarks!!}
        <br>
        <br> @endif
      </p>
    </div>
    <div class="col-xs-6">
      <p class="lead">Summary</p>

      <div class="table-responsive">
        <table class="table">
          <tbody>
            <tr>
              <th style="width:50%"># of Items:</th>
              <td>{!!$cart->getTotalQTY()!!} pcs</td>
            </tr>
            <tr>
              <th>Total Fees:</th>
              <td>PHP  {!!$cart->getTotalFee()!!}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-xs-12">
      <button data-toggle="tooltip" title="Print Receipt" onclick="javascript:window.print();" target="_blank" class="btn btn-primary pull-right no-print"
        style="margin-right: 5px;">
        <i class="fa fa-print"></i> Print</button>
      University of The Philippines Visayas - Tacloban College
      <br> Division of Natural Sciences and Mathematics
    </div>
  </div>
</section>

@endsection