@extends('adminlte::page_user')
@section('content')
  
<h1>Hello {{Auth::user()->name}}!</h1>

@endsection
