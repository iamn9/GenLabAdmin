@extends('adminlte::page_user')
@section('title','GLS | '.$title)
@section('content')

<div class="box box-primary">
    <div class="box-header">
        <h1>{{$title}}</h1>
        
    </div>
    <div class="box-body">
        <table class = "dataTable table table-striped table-bordered table-hover" style = 'background:#fff'>
            <thead>
                <th style="width: 60px">ItemID</th>
                <th>Name</th>
                <th>Qty</th>
                <th style="width: 220px">actions</th>
            </thead>
            <tbody>
                @foreach($cart_items as $cart_item) 
                <tr id='{!!$cart_item->id!!}'>
                    <td><a href="item/{!!$cart_item->item_id!!}">{!!$cart_item->item_id!!}</a></td>
                    <td>{!!$cart_item->name!!}</td>
                    <td>
                        <form method="POST" action='{!! url("cart_item")!!}/{!!$cart_item->id!!}/update'>
                            <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                            <input type = "number" id="qty" name="qty" min="1" value="{!!$cart_item->qty!!}" style="width: 60px;">
                            <button data-toggle="tooltip" title="Update Item QTY." class = 'update btn btn-warning btn-xs' type ='submit' ><i class="fa fa-refresh" aria-hidden="true"></i>  Update</button>
                        </form>
                    </td>
                    <td>
                        <a data-toggle="tooltip" title="Remove this Item from cart." href = '#' data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-xs' data-link = "/cart_item/{!!$cart_item->id!!}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i>  Remove</a>
                        <a data-toggle="tooltip" title="View Item Information." href = '#' data-toggle="modal" data-target="#myModal" class = 'delete btn btn-primary btn-xs' data-link = "/item/{!!$cart_item->item_id!!}/showModal" ><i class="fa fa-info" aria-hidden="true"></i>  Item Info</a>
                    </td>
                </tr>
                @endforeach 
            </tbody>
        </table>
        <br>
        @if(count($cart_items))
            <form method = 'POST' action = '/cart/{{$cart_id}}/checkout'>
                <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                <h4>Remarks: <small>(Type message before checkout)</small></h4>
                <textarea data-toggle="tooltip" title="Add a note to your reservation."  id="remarks" name="remarks" class="textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$remarks}}</textarea>
                <button data-toggle="tooltip" title="Reserve the items."  class = 'btn btn-success btn-lg' style="float:right;"type="submit">CHECKOUT</button>
            </form>
            </div>
        @endif
    </div>
</div>

@endsection