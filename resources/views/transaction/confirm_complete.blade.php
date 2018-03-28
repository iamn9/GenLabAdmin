@extends('adminlte::page')
@section('title','GLS | '.$title)
@section('content')

<script>
  function findTotalFee(){
    var arr = document.getElementsByClassName('fee');
    var totalFee = 0.00;
    for (var i = 0; i < arr.length; i++) {
      if (parseFloat(arr[i].value), 2)
        totalFee += parseFloat(arr[i].value, 2);
    }
    var totDisp = document.getElementById('totFee');
    totDisp.innerHTML = totalFee;

    var totBorrowed = document.getElementById("totBorrowed").innerHTML;
    var totReturned = document.getElementById("totReturned").innerHTML;

    var recordBtn = document.getElementById("recordBtn");
    if (parseFloat(totDisp.innerHTML) != 0){
        //recordBtn activated
        recordBtn.removeAttribute("disabled");
        recordBtn.disabled = false;
    } else{
      if (totBorrowed == totReturned){
        //recordBtn disabled
        recordBtn.setAttribute("disabled", "disabled");
        recordBtn.disabled = true;
      }
    }
  }

  function findTotalReturned() {
    var arr = document.getElementsByClassName('returned');
    var totBorrowed = document.getElementById("totBorrowed").innerHTML;
    var totReturned = 0;
    for (var i = 0; i < arr.length; i++) {
      if (parseInt(arr[i].value))
        totReturned += parseInt(arr[i].value);
    }
    var totDisp = document.getElementById('totReturned');
    totDisp.innerHTML = totReturned;

    var completeBtn = document.getElementById("completeBtn");
    var recordBtn = document.getElementById("recordBtn");
    var totFee = document.getElementById('totFee').innerHTML
    if (totBorrowed == totReturned) {
      completeBtn.removeAttribute("disabled");
      completeBtn.disabled = false;
      //fix this. cannot disable button
      if (parseFloat(totFee) == 0){
        recordBtn.setAttribute("disabled", "disabled");
        recordBtn.disabled = true;  
      }
    } else {
      completeBtn.setAttribute("disabled", "disabled");
      completeBtn.disabled = true;
      recordBtn.removeAttribute("disabled");
      recordBtn.disabled = false;
    }

  }
  window.onLoad = function () {
    findTotalReturned();
    findTotalFee();
  }

  function setMax(theElement) {
    document.getElementById(theElement).value = $('#' + theElement).attr('max');
    findTotalReturned();
  }

  function setZero(theElement) {
    document.getElementById(theElement).value = 0;
    findTotalReturned();
  }
</script>

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
        @if($cart->status == "Completed")
          Submitted: {!!date('F j, Y g:i A', strtotime($transaction->submitted_at))!!} <br>
          Prepared: {!!date('F j, Y g:i A', strtotime($transaction->prepared_at))!!} <br>
          Released: {!!date('F j, Y g:i A', strtotime($transaction->released_at))!!} <br>
          Completed: {!!date('F j, Y g:i A', strtotime($transaction->completed_at))!!} <br>
        @endif @if($cart->status == "Released")
          Submitted: {!!date('F j, Y g:i A', strtotime($transaction->submitted_at))!!} <br>
          Prepared: {!!date('F j, Y g:i A', strtotime($transaction->prepared_at))!!} <br>
          Released: {!!date('F j, Y g:i A', strtotime($transaction->released_at))!!} <br>
        @endif @if($cart->status == "Prepared")
          Submitted: {!!date('F j, Y g:i A', strtotime($transaction->submitted_at))!!} <br>
          Prepared: {!!date('F j, Y g:i A', strtotime($transaction->prepared_at))!!} <br>
        @endif @if($cart->status == "Pending")
          Submitted: {!!date('F j, Y g:i A', strtotime($transaction->submitted_at))!!} <br>
        @endif
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
            <th>Name</th>
            <th>Brand</th>
            <th>Fees</th>
            <th>Qty</th>
            <th class="no-print">Returned QTY</th>
          </tr>
        </thead>
        <form method="POST" action="/accountability/{!!$transaction->id!!}/recordBill">
        <tbody>
          @foreach($cart_items as $cart_item)
          <tr id="{!!$cart_item->id!!}">
            <td>{!!$cart_item->getItemName()!!}</td>
            <td>{!!$cart_item->getItemBrand()!!}</td>
            <td>
              <div class="input-group">
                <span class="input-group-addon">PHP</span>
                <input onChange="findTotalFee()" type="number" min="0.00" name="fee{!!$cart_item->id!!}" id="fee{!!$cart_item->id!!}" class="fee form-control" placeholder="0.00" value="{!!$cart_item->getFee()!!}" step=".01">
              </div>
            </td>
            <td>{!!$cart_item->qty!!}</td>
            <td>
              <div class="input-group no-print">
                <input onChange="findTotalReturned()" type="number" name="returned{!!$cart_item->id!!}" id="returned{!!$cart_item->id!!}" name="qty" min="0" max="{!!$cart_item->qty!!}" value="0" class="returned form-control">
                <span class="input-group-btn">
                <button type="button" onclick="setZero('returned{!!$cart_item->id!!}')" class="btn btn-danger">
                  <i class="fa fa-close"></i>
                </button>
                <button type="button" onclick="setMax('returned{!!$cart_item->id!!}')" class="btn btn-success">
                  <i class="fa fa-check"></i>
                </button>
                </span>
              </div>
            </td>
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
        @if ($cart->remarks != "")
          {!!$cart->remarks!!}
        @endif
      </p>
    </div>
    <div class="col-xs-6">
      <p class="lead">Summary</p>
      <div class="table-responsive">
        <table class="table">
          <tbody>
            <tr>
              <th style="width:50%"># of Borrowed Items:</th>
              <td><b><div id="totBorrowed">{!!$cart->getTotalQty()!!}</div></b></td>
            </tr>
            <tr>
              <th style="width:50%"># of Returned Items:</th>
              <td><b><div id="totReturned">0</div></b></td>
            </tr>
            <tr>
              <th>Total Fees:</th>
              <td><b>PHP <div id="totFee" style="display: inline">{!!$cart->getTotalFee()!!}</div></b></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-xs-12">
        <input type='hidden' name='_token' value='{{Session::token()}}'>
        <button id="recordBtn" data-toggle="tooltip" title="Will be paid at a later time." class="btn btn-warning pull-right no-print" style="margin-right: 5px;"
          type="submit">
          <i class="fa fa-book" aria-hidden="true"></i> Record Bill</button>
      </form>
      <form method="POST" action='/accountability/{!!$cart->trans_id!!}/paidCart'>
        <input type='hidden' name='_token' value='{{Session::token()}}'>
        <button id="completeBtn" data-toggle="tooltip" title="Payment received." class="btn btn-success pull-right no-print" style="margin-right: 5px;"
          type="submit" disabled>
          <i class="fa fa-check" aria-hidden="true"></i> Paid/Returned Completely</button>
      </form>
      <!-- <button data-toggle="tooltip" title="Print Receipt"  onclick="javascript:window.print();" target="_blank" class="btn btn-primary pull-right no-print" style="margin-right: 5px;"><i class="fa fa-print"></i> Print</button> -->
      University of The Philippines Visayas - Tacloban College
      <br> Division of Natural Sciences and Mathematics
    </div>
  </div>
</section>

@endsection