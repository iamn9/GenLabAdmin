@extends('scaffold-interface.layouts.app')
@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
	   <div class='w3-animate-zoom'><br>
	      <h3>Welcome to GenLab, {{Auth::user()->name}}!</h3>
	   </div>
	   <h2>Here are your transactions:</h2>
  <div class="tbl-header">
    <table cellpadding="0" cellspacing="0" border="0">
      <thead>
        <tr>
          <th>Cart ID</th>
          <th>Items</th>
          <th>Status</th>
        </tr>
      </thead>
    </table>
  </div>
  <div class="tbl-content">
    <table cellpadding="0" cellspacing="0" border="0">
      <tbody>
       
      </tbody>
    </table>
  </div>
	  
	</div>
	
  

 </body>

  
  
@endsection
