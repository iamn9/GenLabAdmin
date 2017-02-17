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
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
  
  <div class="box-body">

      <div class="col-md-3 col-sm-6 col-xs-12 small-box bg-yellow">
        <div class="inner">
          <h3>{!!$count_unactivatedUsers!!}</h3>

          <p>User Registrations</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="users/unactivated" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>

      <div class="col-md-3 col-sm-6 col-xs-12 small-box bg-aqua">
        <div class="inner">
          <h3>{!!$count_newOrders!!}</h3>

          <p>New Orders</p>
        </div>
        <div class="icon">
          <i class="fa fa-shopping-cart"></i>
        </div>
        <a href="#" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>

      <div class="col-md-3 col-sm-6 col-xs-12 small-box bg-green">
        <div class="inner">
          <h3>{!!$count_completed!!}</h3>

          <p>Completed Transactions</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
  </div>
</div>

<!--LATEST ORDERS-->
<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Latest Transactions</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="table-responsive">
      <table class="table no-margin">
        <thead>
          <tr>
           <th>Timestamp</th>
           <th>Order ID</th>
           <th>Borrower Name</th>
           <th>Status</th>
         </tr>
       </thead>
       <tbody>
        @foreach($transactions as $transaction)
        <tr>
         <td>{!!$transaction->submitted_at!!}</td>
         <td><a href="cart/{!!$transaction->cart_id!!}">{!!$transaction->cart_id!!}</a></td>
         <td>{!!$transaction->name!!}</td>
         <td><span class="label label-info">{!!$transaction->status!!}</span></td>
       </tr>
       @endforeach
     </tbody>
   </table>
 </div>
 <!-- /.table-responsive -->
</div>
<!-- /.box-body -->
<div class="box-footer clearfix">
  <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
</div>
<!-- /.box-footer -->
</div>
<!--End of Order Summary-->


@stop 