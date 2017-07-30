@extends('scaffold-interface.layouts.app')
@section('content')
 <style>
 	@import url('https://fonts.googleapis.com/css?family=Raleway');
 	h3 {
 		font-family: 'Raleway', sans-serif;
 		font-size: 30px;
 		text-align: center;
 	}
 	h2 {
 		font-size: 20px;
 	}
 	h1{
  font-size: 30px;
  color: #fff;
  text-transform: uppercase;
  font-weight: 300;
  text-align: center;
  margin-bottom: 15px;
}
table{
  width:100%;
  table-layout: fixed;
}
.tbl-header{
  background-color: rgba(0, 0, 0, 0.7);
  width: 97%;
 }
.tbl-content{
  height:400px;
  width: 97%;
  overflow-x:auto;
  margin-top: 0px;
  border: 1px solid rgba(0,0,0, 0.9);
}
th{
  padding: 20px 15px;
  text-align: left;
  font-weight: 500;
  font-size: 12px;
  color: #fff;
  text-transform: uppercase;
}
td{
  padding: 15px;
  text-align: left;
  vertical-align:middle;
  font-weight: 300;
  font-size: 12px;
  color: black;
  border-bottom: solid 1px rgba(0,0,0,0.7);
}
 </style>
 <head>

 </head>

 <body>
 	<div class="container">
	   <h3>Welcome to GenLab, {{Auth::user()->name}}!</h3>
	   <h2>Here are the updates on your transactions:</h2>
  <div class="box-body">
    <br>
     @foreach($carts as $cart) 
      <li>You're cart <a href="/cart/{!!$cart->id!!}" style="text-decoration-line: underline;">#{!!$cart->id!!} </a>was {!!$cart->status!!}.</li>
    @endforeach 
  </div>
</div>
</body>

  
  
@endsection
