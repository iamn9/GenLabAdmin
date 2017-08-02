@extends('scaffold-interface.layouts.app')
@section('title','Show')
@section('content')

<section class='content'>

<div class="box box-primary">
    <div class="box-header">
        <h1>USER CART</h1>
        <form method = 'GET'>
             @if($searchWord != "")
                Showing search results for "<b>{{$searchWord}}</b>".
            @endif
            <div class="input-group" >
                <input type="text" name="search" class="form-control pull-right" placeholder="Search" value='{!!$searchWord!!}'>
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
                <th>name</th>
                <th>qty</th>
                <th>actions</th>
            </thead>
            <tbody>
                @foreach($cart_items as $cart_item) 
                <tr>
                    <td>{!!$cart_item->item_id!!}</td>
                    <td>{!!$cart_item->name!!}</td>
                    <td>{!!$cart_item->qty!!}</td>
                    <td>
                        <a href = '#' data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-xs' data-link = "/cart_item/{!!$cart_item->id!!}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i>  Remove</a>
                        <a href = '#' class = 'viewEdit btn btn-warning btn-xs' data-link = '/cart_item/{!!$cart_item->id!!}/edit'><i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Edit</a>
                        <a href = '#' data-toggle="modal" data-target="#myModal" class = 'delete btn btn-primary btn-xs' data-link = "/item/{!!$cart_item->item_id!!}/showModal" ><i class="fa fa-info" aria-hidden="true"></i>  Item Info</a>
                    </td>
                </tr>
                @endforeach 
            </tbody>
        </table>
        <div class='text-center'>{!! $cart_items->render() !!}</div>
            <br>
        @if(!is_null($cart_id))
        <div class="input-group">    
            <button id = "myBtn" class = 'btn btn-success'>CHECKOUT</button>
        @endif
        </div>
    </div>
</div>

    @include('cart.checkout_modal')

    <script>
    // Get the modal
    var modal = document.getElementById('myModal');

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>
    
</section>
@endsection