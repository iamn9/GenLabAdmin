@extends('adminlte::page_user')
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
      <div class="col-md-3 col-sm-6 col-xs-12 small-box bg-red">
        <div class="inner">
          <h3>{!!$count_unreturnedCarts!!}</h3>
          <p>Unreturned Carts</p>
        </div>
        <div class="icon">
          <i class="fa fa-bars"></i>
        </div>
        <a href="#" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 small-box bg-orange">
        <div class="inner">
          <h3>{!!$count_pendingCarts!!}</h3>
          <p>Pending Carts</p>
        </div>
        <div class="icon">
          <i class="fa fa-bars"></i>
        </div>
        <a href="#" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 small-box bg-green">
        <div class="inner">
          <h3>{!!$count_readyCarts!!}</h3>
          <p>Carts Ready</p>
        </div>
        <div class="icon">
          <i class="fa fa-bars"></i>
        </div>
        <a href="#" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
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
              <th>Details</th>
            </tr>
        </thead>
        <tbody>
           @foreach($news as $entry) 
            <tr>
                <td>{!!$entry->name!!}</td>
                <td>{!!date('F j, Y g:i A', strtotime($entry->date_posted))!!}</td>
                <td>{!!$entry->content!!}</td>
            </tr>
            @endforeach 
        </tbody>
      </table>
    </div>
  </div>
  
 <!-- /.table-responsive -->
</div>
  <div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">My Latest Transactions</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="collapse" ><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="close"><i class="fa fa-times"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="table-responsive">
      <table class="table no-margin">
        <thead>
          <tr>
           <th>Timestamp</th>
           <th style="width: 30px">OrderID</th>
           <th>Status</th>
         </tr>
       </thead>
       <tbody>
        @foreach($transactions as $transaction)
        <tr>
         <td> {!!date('F j, Y g:i A', strtotime($transaction->submitted_at))!!}</td>
         <td><a href="cart/{!!$transaction->cart_id!!}">{!!$transaction->cart_id!!}</a></td>
         <td>
            @if($transaction->status == "Pending")
              <span class="label label-warning">
            @elseif($transaction->status == "Prepared")
              <span class="label label-success">
            @elseif($transaction->status == "Released")    
                <span class="label label-danger">
            @elseif($transaction->status == "Completed")
              <span class="label label-primary">
            @else
              <span class="label label-info">
            @endif{!!$transaction->status!!}</span></td>
       </tr>
       @endforeach
     </tbody>
   </table>
 </div>
<div class="box-footer clearfix">
</div>
@stop 