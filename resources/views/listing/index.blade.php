@extends('adminlte::page')
@section('title','Index')
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>{{$title}}</h1>
    @include('search')
    <br>
    <form class = 'col s3' method = 'get' action = '{!!url("listing")!!}/create'>
        <button class = 'btn btn-primary' type = 'submit'>Create New Listing</button>
    </form>
</div>
<div class="box-body">
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th style="width:200px">borrower_id</th>
            <th>Borrower Name</th>
            <th style="width: 200px">actions</th>
        </thead>
        <tbody>
            @foreach($listing as $listings) 
            <tr id='{!!$listings->id!!}'>
                <td>{!!$listings->owner_id!!}</td>
                <td>{!!$listings->getOwner()!!}</td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    <div class='text-center'>{!! $listing->render() !!}</div>
</div>
</div>
@endsection