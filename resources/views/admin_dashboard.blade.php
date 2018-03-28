@extends('adminlte::page')

@section('title', 'GenLab System')

@section('content_header')
<h1>Hello {{Auth::user()->name}}!</h1>
@stop

@section('content')

<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">General Summary</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="collapse" ><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="close"><i class="fa fa-times"></i></button>
    </div>
  </div>
  
  <div class="box-body">

      <div class="col-md-3 col-sm-6 col-xs-12 small-box bg-yellow">
        <div class="inner">
          <h3>{!!$count_unactivatedUsers!!}</h3>

          <p>User Registrations</p>
        </div>
        <div class="icon">
          <i class="fa fa-user-plus"></i>
        </div>
        <!-- <a href="users/unactivated" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a> -->
      </div>

      <div class="col-md-3 col-sm-6 col-xs-12 small-box bg-aqua">
        <div class="inner">
          <h3>{!!$count_newOrders!!}</h3>

          <p>New Orders</p>
        </div>
        <div class="icon">
          <i class="fa fa-shopping-cart"></i>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 col-xs-12 small-box bg-green">
        <div class="inner">
          <h3>{!!$count_completed!!}</h3>

          <p>Completed Transactions</p>
        </div>
        <div class="icon">
          <i class="fa fa-bars"></i>
        </div>
      </div>
  </div>
</div>

<!--LATEST ORDERS-->
<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Latest Transactions</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="collapse" ><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="close"><i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="table-responsive">
      <table class="table no-margin">
        <thead>
          <tr>
           <th>Timestamp</th>
           <th>Borrower Name</th>
           <th>OrderID</th>
           <th>Status</th>
         </tr>
       </thead>
       <tbody>
        @foreach($transactions as $transaction)
        <tr>
         <td> {!!date('F j, Y g:i A', strtotime($transaction->submitted_at))!!}</td>
         <td>{!!$transaction->name!!}</td>
         <td><a href="cart/{!!$transaction->cart_id!!}">{!!$transaction->cart_id!!}</a></td>
         <td>
            @if($transaction->status == "Draft")
                <span class="label label-info">
            @elseif($transaction->status == "Pending")
                <span class="label label-danger">
            @elseif($transaction->status == "Prepared")
                <span class="label label-warning">
            @elseif($transaction->status == "Released")
                <span class="label label-primary">
            @elseif($transaction->status == "Completed")
                <span class="label label-success">
            @else
                <span class="label label-info">
            @endif
            {!!$transaction->status!!}</span></td>
       </tr>
       @endforeach
     </tbody>
   </table>
 </div>
</div>
</div>

<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Fresh Announcements</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="collapse" ><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="close"><i class="fa fa-times"></i></button>
    </div>
  </div>
 <div class="box-body">
    <div class="table-responsive">
      <table class="table no-margin">
        <thead>
            <tr>
              <th>Author</th>
              <th>Date Posted</th>
              <th>Title</th>
              <th>Details</th>
            </tr>
        </thead>
        <tbody>
           @foreach($news as $entry) 
            <tr>
                <td>{!!$entry->getReporterName()!!}</td>
                <td>{!!date('F j, Y g:i A', strtotime($entry->date_posted))!!}</td>
                <td>{!!$entry->title!!}</td>
                <td>{!!$entry->content!!}</td>
            </tr>
            @endforeach 
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
@stop 