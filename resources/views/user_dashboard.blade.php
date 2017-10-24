@extends('adminlte::page_user')
@section('title', 'GenLab System')
@section('content_header')
<h1>Hello {{Auth::user()->name}}!</h1>
@stop

@section('content')

<!--Updates-->
<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Updates</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    Nothing to see.
  </div>
<div class="box-footer clearfix">
  <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">Button</a>
</div>
</div>
<!--End of Order Summary-->
@stop 