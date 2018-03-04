@extends('adminlte::page')
@section('title','Index')
@section('content')

<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Top 5 Most Borrowed Items</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
  	 <table class = "dataTable table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
        <th style="width: 170px">Name</th>
        <th style="width: 230px">Count</th>
        </thead>
        <tbody>
            @foreach($mostBorrowed as $entry) 
           <tr>
            <td>{!!$entry->name!!}</td>
            <td>{!!$entry->total!!}</td>
           </tr>
            @endforeach 
        </tbody>
    </table>
  
    </div>
   </div>
@endsection