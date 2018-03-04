@extends('adminlte::page') @section('title','GLS | '.$title) @section('content')

<div class="box box-primary">
    <div class="box-header">
        <h1>{{$title}} &nbsp
            <a data-toggle="tooltip" title="Edit Cart Information." class='viewEdit btn btn-primary btn-xs'
                href='/cart/{!!$cart->id!!}/edit'>
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
        </h1>
        <table class='table table-bordered'>
            <thead>
                <th>Key</th>
                <th>Value</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <b>
                            <i>borrower_id : </i>
                        </b>
                    </td>
                    <td>{!!$cart->borrower_id!!}</td>
                </tr>
                <tr>
                    <td>
                        <b>
                            <i>status : </i>
                        </b>
                    </td>
                    <td>{!!$cart->status!!}</td>
                </tr>
                <tr>
                    <td>
                        <b>
                            <i>remarks : </i>
                        </b>
                    </td>
                    <td>{!!$cart->remarks!!}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="box-body">
        <table class="dataTable table table-striped table-bordered table-hover" style='background:#fff'>
            <thead>
                <th>item_id</th>
                <th>name</th>
                <th>qty</th>
                <th>actions</th>
            </thead>
            <tbody>
                @foreach($cart_items as $cart_item)
                <tr>
                    <td>{!!$cart_item->item_id!!}</td>
                    <td>{!!$cart_item->name!!}</td>
                    @if($cart->status != "Completed" && $cart->status != "Released")
                    <td>
                        <form method="POST" action='{!! url("cart_item")!!}/{!!$cart_item->id!!}/update'>
                            <input type='hidden' name='_token' value='{{Session::token()}}'>
                            <input type="number" id="qty" name="qty" min="1" value="{!!$cart_item->qty!!}" style="width: 80px;">
                            <button data-toggle="tooltip" title="Update Item QTY." class='update btn btn-warning btn-xs' type='submit'>
                                <i class="fa fa-refresh" aria-hidden="true"></i> Update</button>
                        </form>
                    </td>
                    <td>

                        <a data-toggle="tooltip" title="Remove item from cart." href='{!!url("cart")."/".$cart_item->cart_id!!}' data-link='/cart_item/{!!$cart_item->id!!}/delete'
                            class='delete btn btn-danger btn-xs'>
                            <i class='material-icons'>delete</i>
                        </a>
                        @else
                        <td>{!!$cart_item->qty!!}</td>
                        <td>
                            @endif
                            <a data-toggle="tooltip" title="View Item Information." href='/item/{!!$cart_item->item_id!!}' class='delete btn btn-primary btn-xs'>
                                <i class="fa fa-info" aria-hidden="true"></i> Item Info</a>
                        </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class='text-center'>{!! $cart_items->render() !!}</div>
    </div>
</div>
@endsection