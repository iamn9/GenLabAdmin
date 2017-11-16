@extends('adminlte::page')
@section('title','Index')
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>News Index</h1>
     @include('search')
</div>

<div class="box-body">
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
        <th style="width: 170px">Author</th>
        <th style="width: 230px">Date Posted</th>
        <th>News Content</th>
        </thead>
        <tbody>
            @foreach($news as $entry) 
            <tr id='{!!$entry->id!!}'>
                <td>{!!$entry->name!!}</td>
                <td>{!!date('F j, Y g:i A', strtotime($entry->date_posted))!!}</td>
                <td>{!!$entry->content!!}</td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    <div class='text-center'>{!! $news->render() !!}</div>
</div>
</div>
@endsection