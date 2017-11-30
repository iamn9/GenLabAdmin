@extends('adminlte::page')
@section('title','Index')
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>{!!$title!!}</h1>
    @include('search')
</div>
<div class="box-body">
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th>#</th>
            <th>Borrower ID</th>
            <th>Name</th>
            <th>Date borrowed</th>
			<th>Due date</th>
            <th>Elapsed time</th>            
            <th>Amount payable</th>
			<th>Actions</th>
        </thead>
        <tbody>
            @foreach($accountabilities as $accountability) 
            <tr id='{!!$accountability->id!!}'>
                <td>{!!$accountability->id!!}'</td>
                <td>{!!$accountability->borrower_id!!}</td>
				<td>{!!$accountability->borrower_name!!}</td>
                <td> {!!date('F j, Y g:i A', strtotime($accountability->date_borrowed))!!}</td>                
				<td> {!!date('F j, Y g:i A', strtotime($accountability->due_date))!!}</td>                
				<td>"--"</td>
				<td>{!!$accountability->total_fee!!}</td>				
				<td>
                    <a href = '#' data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-xs' data-link = "/item/{!!$item->id!!}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i>  Delete</a>
                    <a class = 'viewEdit btn btn-primary btn-xs' href = '/item/{!!$item->id!!}/edit'><i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Edit</a>
                    <a class = 'viewShow btn btn-warning btn-xs' href = '/item/{!!$item->id!!}'><i class="fa fa-info" aria-hidden="true"></i>  Info</a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    <div class='text-center'>{!! $accountabilities->render() !!}</div>
</div>
</div>
@endsection