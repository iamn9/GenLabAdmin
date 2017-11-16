@extends('adminlte::page_user')
@section('title', 'GenLab System')
@section('content_header')
<h1>Hello {{Auth::user()->name}}!</h1>
@stop

@section('content')

<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Fresh Announcements</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="table-responsive">
      <table class="table no-margin">
        <thead>
            <tr>
              <th style="width: 170px">Author</th>
              <th style="width: 230px">Date Posted</th>
              <th>Details</th>
            </tr>
        </thead>
        <tbody>
           @foreach($news as $entry) 
            <tr>
                <td>{!!$entry->name!!}</td>
                <td>{!!date('F j, Y g:i A', strtotime($entry->date_posted))!!}</td>
                <td>{!!$entry->news!!}</td>
            </tr>
            @endforeach 
        </tbody>
      </table>
    </div>
  </div>
</div>
@stop 