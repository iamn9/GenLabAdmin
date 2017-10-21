@extends('scaffold-interface.layouts.app')
@section('title','Index')
@section('content')

<section class='content'>
<div class="box box-primary">
<div class="box-header">
    <h1>Item Index</h1>
    @include('search')
</div>

<div class="box-body">
    <br>
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th style="width: 60px">id</th>
            <th style="width: 210px">name</th>
            <th>description</th>
            <th style="width: 160px">actions</th>
        </thead>
        <tbody>
            @foreach($items as $item) 
            <tr>
                <td>{!!$item->id!!}</td>
                <td>{!!$item->name!!}</td>
                <td>{!!$item->description!!}</td>
                <td>
                    <a data-toggle="modal" data-target="#myModal" class = 'delete btn btn-success btn-xs' data-link = "/cart/add/{!!$item->id!!}/addItemMsg" ><i class="fa fa-cart-plus" aria-hidden="true"></i>  Add to Cart</a>

                    <a href = '#' class = 'viewShow btn btn-primary btn-xs' data-link = '/item/{!!$item->id!!}'><i class="fa fa-info" aria-hidden="true"></i>  Info</a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    <div class='text-center'>{!! $items->render() !!}</div>
</div>
</div>
</section>
@endsection