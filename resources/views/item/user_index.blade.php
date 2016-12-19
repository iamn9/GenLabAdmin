@extends('scaffold-interface.layouts.app')
@section('title','Index')
@section('content')

<section class='content'>
<div class="box box-primary">
<div class="box-header">
    <h1>Item Index</h1>
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
    <br>
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th>name</th>
            <th>description</th>
            <th>actions</th>
        </thead>
        <tbody>
            @foreach($items as $item) 
            <tr>
                <td>{!!$item->name!!}</td>
                <td>{!!$item->description!!}</td>
                <td>

                    <button type="button" class="viewShow btn btn-warning btn-xs" data-toggle="modal" data-target="#addToListing">Add to Listing</button>

                    <!-- Modal -->
                    <div id="addToListing" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add to Listing</h4>
                          </div>
                          <div class="modal-body">
                            <p>You are adding {!!$item->name!!}</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <a href = '/cart/add/{!!$item->id!!}' class = 'viewShow btn btn-primary btn-xs'><i class = 'material-icons'>Add to Cart</i></a>

                    <a href = '#' class = 'viewShow btn btn-warning btn-xs' data-link = '/item/{!!$item->id!!}'><i class = 'material-icons'>info</i></a>
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