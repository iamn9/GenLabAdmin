@extends('scaffold-interface.layouts.app')
@section('content')
  
  <div class="container">
  <h1>Hello {{Auth::user()->name}}!</h1>

@endsection
