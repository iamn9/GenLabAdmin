@extends('adminlte::page')
@section('title','Show')
@section('content')

<div class="box box-primary no-print">
<div class="box-header">
    <h1>{!!$title!!}</h1>
    <form method = 'get' action = '{!!url("transaction")!!}'>
        <button class = 'btn btn-primary' onclick="javascript:history.back()"> Back</button>
    </form>
    <br>
</div>
</div>



<section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-flask"></i> GenLab System
            <small class="pull-right">Date: 2/10/2014</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        
        <div class="col-sm-4 invoice-col">
          <address>
            <strong>Name</strong><br>
            Email<br>
            Student NUmber<br>
            Phone: (555) 539-1037<br>
          </address>
        </div>
        <!-- /.col -->

        
        <div class="col-sm-4 invoice-col">
        <strong>Transaction Details</strong><br>
          <address>
            Submitted: {!!$transaction->submitted_at!!}<br>
            Disbursed: {!!$transaction->disbursed_at!!}<br>
            Completed: {!!$transaction->completed_at!!}<br>
          </address>
        </div>
        <!-- /.col -->

        <div class="col-sm-4 invoice-col">
          <b>Transaction #:</b> {!!$transaction->id!!}<br>
          <b>Cart ID:</b> {!!$transaction->cart_id!!}<br>
          <b>Processed by:</b> Name of Admin<br>
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
              <th>Description</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cart_items as $cart_item)
            <tr>
              <td>{!!$cart_item->qty!!}</td>
              <td>{!!$cart_item->item_id!!}</td>
              <td>El snort testosterone trophy driving gloves handsome</td>
            </tr>
            @endforeach
            </tbody>
          </table>
          <hr>
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