@extends('adminlte::page')
@section('title', 'GenLab System')

@section('content_header')
  <h1>Hello {{Auth::user()->name}}!</h1>
@stop

@section('content')

<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">User Registrations</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="collapse">
        <i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="close">
        <i class="fa fa-times"></i>
      </button>
    </div>
  </div>
  <div class="box-body">
    <div class="col-md-3 small-box bg-aqua">
      <div class="inner">
        <h3>{!!$users->count()!!}</h3>

        <p>User Registrations</p>
      </div>
      <div class="icon">
        <i class="fa fa-user-plus"></i>
      </div>
    </div>
    <div class="col-md-9 table-responsive">
      <table class="dataTable table no-margin">
        <thead>
          <tr>
            <th>Timestamp</th>
            <th>Account Name</th>
            <th>Email Address</th>
            <th>ID Number</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
          <tr>
            <td> {!!date('F j, Y g:i A', strtotime($user->updated_at))!!}</td>
            <td>{!!$user->name!!}</td>
            <td>{!!$user->email!!}</td>
            <td>{!!$user->id_no!!}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Latest Transactions</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="collapse">
        <i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="close">
        <i class="fa fa-times"></i>
      </button>
    </div>
  </div>
  <div class="box-body">
    <div class="col-md-3 small-box bg-orange">
      <div class="inner">
        <h3>{!!$transactions->count()!!}</h3>

        <p>Unprepared Requests</p>
      </div>
      <div class="icon">
        <i class="fa fa-shopping-cart"></i>
      </div>
    </div>
    <div class="col-md-9 table-responsive">
      <table class="dataTable table no-margin">
        <thead>
          <tr>
            <th>Timestamp</th>
            <th>Name</th>
            <th>OrderID</th>
          </tr>
        </thead>
        <tbody>
          @foreach($transactions as $transaction)
          <tr>
            <td> {!!date('F j, Y g:i A', strtotime($transaction->submitted_at))!!}</td>
            <td>{!!$transaction->getOwner()!!}</td>
            <td>
              <a href="cart/{!!$transaction->cart_id!!}">{!!$transaction->cart_id!!}</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Accountabilities</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="collapse">
        <i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="close">
        <i class="fa fa-times"></i>
      </button>
    </div>
  </div>

  <div class="box-body">
    <div class="col-md-3 small-box bg-red">
      <div class="inner">
        <h3>{!!$accountabilities->count()!!}</h3>

        <p>Accountabilities</p>
      </div>
      <div class="icon">
        <i class="fa fa-user-plus"></i>
      </div>
    </div>
    <div class="col-md-9 table-responsive">
      <table class="dataTable table no-margin">
        <thead>
          <tr>
            <th>Timestamp</th>
            <th>Name</th>
            <th>Item</th>
            <th>Qty</th>
            <th>Amount</th>
          </tr>
        </thead>
        <tbody>
          @foreach($accountabilities as $accountability)
          <tr>
            <td> {!!date('F j, Y g:i A', strtotime($accountability->date_incurred))!!}</td>
            <td>{!!$accountability->getOwner()!!}</td>
            <td>
                <a href="/item/{!!$accountability->item_id!!}">{!!$accountability->getItemName()!!}</a>
            </td>
            <td>{!!$accountability->qty!!}</td>
            <td>{!!$accountability->amount!!}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

@stop