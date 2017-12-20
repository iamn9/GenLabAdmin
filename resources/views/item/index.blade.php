@extends('adminlte::page')
@section('title','Index')
@section('content')

<div class="box box-primary">
<div class="box-header">
    <h1>Item Index</h1>
    @include('search')
</div>

<div class="box-body">
    <form class = 'col s3' method = 'get' action = '{!!url("item")!!}/create'>
        <button class = 'btn btn-primary addBtn' type = 'submit'>Create New item</button>
		<a data-toggle="modal" data-target="#addBtn" class = 'upload btn btn-primary'  data-link = "" ><i aria-hidden="true"></i> Add New Item</a>	      
		<a data-toggle="modal" data-target="#uploadBtn" class = 'upload btn btn-primary'  data-link = "/item/1/uploadMsg" ><i aria-hidden="true"></i>Import</a>	  
    </form>		
  
		 <div id="addBtn" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h5 class="modal-title" id="myModalLabel">Add an equipment</h5>
			  </div>
			  <div class="modal-body">
				<form>
				  <div class="form-group">
					<label class="control-label mb-10">Equipment Name</label>
					<select class="form-control" name="medicine_id" id="medicine_id">
					  @foreach($items as $item)
					  <option value="{{$item->id}}" >{{$item->generic_name}}</option>
					  @endforeach
					</select>
				  </div>

				  <div class="form-group">
					<label class="control-label mb-10">Brand</label>
					<input type="text" name="dosage_name" id="dosage-volume" class="form-control" placeholder="">
				  </div>

				  <div class="form-group">
					<label class="control-label mb-10">Quantity</label>
					<input type="text" name="form" id="form" class="form-control" placeholder="0">
				  </div>

				  <div class="form-group">
					<label class="control-label mb-10">Acquisition cost</label>
					<input type="text" name="price" id="price" class="form-control" placeholder="0.00 php">
				  </div>
				  
				  <div class="form-group">
					<label class="control-label mb-10">Wattage</label>
					<input type="text" name="price" id="price" class="form-control" placeholder="0.00">
				  </div>

				  <div class="form-group">
					<label class="control-label mb-10">First hour rate</label>
					<input type="text" name="price" id="price" class="form-control" placeholder="0.00 php">
				  </div>
		
				<div class="form-group">
					<label class="control-label mb-10">Succeeding hour rate</label>
					<input type="text" name="price" id="price" class="form-control" placeholder="0.00 php">
				  </div>


				  <div class="form-group">
					<label class="control-label mb-10">Insert a photo</label>
					<div class="panel-wrapper collapse in">
					  <div class="panel-body">
						<div class="mt-20">
						  <input type="file" name="photo" id="input-file-now" class="dropify" >
						</div>  
					  </div>
					</div>
				  </div>

				</form>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-success waves-effect" data-dismiss="modal" id="save-dosage">Save</button>
				<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
			  </div>

			</div>
			<!-- /.modal-content -->
		  </div>
		</div>
		
		<div id="uploadBtn" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h5 class="modal-title" id="myModalLabel"><strong>Upload a file</strong></h5>
			  </div>
			  <div class="modal-body">
				<form>				  				 
				  <div class="form-group">					
					<div class="panel-wrapper collapse in">
					  <div class="panel-body">
						<div class="mt-20">
						  <input type="file" name="file" id="input-file-now" class="dropify" >
						</div>  
					  </div>
					</div>
				  </div>

				</form>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-success waves-effect" data-dismiss="modal" id="save-dosage">Save</button>
				<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
			  </div>

			</div>
			<!-- /.modal-content -->
		  </div>
		</div>
	
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
          <th style="width: 60px">id</th>
          <th style="width: 150px">name</th>
          <th style="width: 150px">brand</th>
          <th style="width: 100px">quantity</th>
            <th>description</th>
            <th style="width: 180px">actions</th>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr id='{!!$item->id!!}'>
                <td>{!!$item->id!!}</td>
                <td>{!!$item->name!!}</td>
                <td>{!!$item->brand!!}</td>
                <td>{!!$item->quantity!!}</td>
                <td>{!!$item->description!!}</td>
                <td>
                    <a href = '#' data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-xs' data-link = "/item/{!!$item->id!!}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i>  Delete</a>
                    <a class = 'viewEdit btn btn-primary btn-xs' href = '/item/{!!$item->id!!}/edit'><i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Edit</a>
                    <a class = 'viewShow btn btn-warning btn-xs' href = '/item/{!!$item->id!!}'><i class="fa fa-info" aria-hidden="true"></i>  Info</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class='text-center'>{!! $items->render() !!}</div>
</div>
</div>
@endsection
