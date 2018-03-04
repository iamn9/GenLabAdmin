@extends('adminlte::page')
@section('title','GLS | '.$title)
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>{{$title}}</h1>
    
    <br>
    <form method = 'get' action = '{!!url("listing")!!}'>
        <button class = 'btn btn-primary'>listing Index</button>
    </form>
    <br>
    <table class = 'table table-bordered'>
        <thead>
            <th>Key</th>
            <th>Value</th>
        </thead>
        <tbody>
        <tr>
                <td>
                    <b><i>Owner ID : </i></b>
                </td>
                <td>{!!$listing->owner_id!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>Owner Name : </i></b>
                </td>
                <td>{!!$listing->getOwner()!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>Name : </i></b>
                </td>
                <td>{!!$listing->name!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>Description : </i></b>
                </td>
                <td>{!!$listing->description!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>Shared : </i></b>
                </td>
                @if ($listing->isShared)
                    <td><i class='glyphicon glyphicon-ok'></i>  true</td>
                @else
                    <td><i class='glyphicon glyphicon-remove'></i>  false</td>
                @endif
            </tr>
        </tbody>
    </table>
</div>
<div class="box-body">
    <table class = "dataTable table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th>item_id</th>
            <th>name</th>
            <th>qty</th>
            <th>actions</th>
        </thead>
        <tbody>
            @foreach($listing_items as $listing_item) 
            <tr id={!!$listing_item->id!!}>
                <td>{!!$listing_item->item_id!!}</td>
                <td>{!!$listing_item->name!!}</td>
                <td>
                    <form method="POST" action='{!! url("listing_item")!!}/{!!$listing_item->id!!}/update'>
                        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                        <input type = "number" id="qty" name="qty" min="1" value="{!!$listing_item->qty!!}" style="width: 80px;">
                        <button data-toggle="tooltip" title="Update QTY of this item." class = 'update btn btn-warning btn-xs' type ='submit' ><i class="fa fa-refresh" aria-hidden="true"></i>  Update</button>
                    </form>
                </td>
                <td>
                    <a data-toggle="tooltip" title="Remove this item from the listing." href = '#' data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-xs' data-link = "/listing_item/{!!$listing_item->id!!}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i>  Delete</a>
                    <a data-toggle="tooltip" title="View Item Information" href = '/item/{!!$listing_item->item_id!!}' class = 'delete btn btn-primary btn-xs' ><i class="fa fa-info" aria-hidden="true"></i>  Item Info</a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    <div class='text-center'>{!! $listing_items->render() !!}</div>
</div>
</div>
@endsection