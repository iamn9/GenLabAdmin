@extends('scaffold-interface.layouts.app')
@section('title','Show')
@section('content')

<section class='content'>
<div class="box box-primary">
<div class="box-header">
    <h1>USER CART</h1>
    <form method = 'GET'>
        <div class="input-group" >
            <input type="text" name="search" class="form-control pull-right" placeholder="Search">
            <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
</div>
<div class="box-body">
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th>item_id</th>
            <th>qty</th>
            <th>actions</th>
        </thead>
        <tbody>
            @foreach($cart_items as $cart_item) 
            <tr>
                <td>{!!$cart_item->item_id!!}</td>
                <td>{!!$cart_item->qty!!}</td>
                <td>
                    <a href = '/cart' data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-xs' data-link = "/cart_item/{!!$cart_item->id!!}/deleteMsg" ><i class = 'material-icons'>delete</i></a>
                    <a href = '#' class = 'viewEdit btn btn-primary btn-xs' data-link = '/cart_item/{!!$cart_item->id!!}/edit'><i class = 'material-icons'>edit</i></a>

                    <button type="button" class="viewShow btn btn-warning btn-xs" data-toggle="modal" data-target="#showItemInfo">Item Info</button>

                    <!-- Modal -->
                    <div id="showItemInfo" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Item Info</h4>
                          </div>
                          <div class="modal-body">
                            <p></p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>

                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    <div class='text-center'>{!! $cart_items->render() !!}</div>
        <br>
    @if(!is_null($cart_id))    
    <form method = 'GET' action = '/cart/{{$cart_id}}/checkout'>
        <button class = 'btn btn-success'>CHECKOUT</button>
    </form>
    @endif
</div>
</div>
</section>
@endsection