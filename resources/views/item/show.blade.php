@extends('scaffold-interface.layouts.app')
@extends('adminlte::page')
@section('title','Show')
@section('content')

<section class="content">
    <h1>
        Show item
    </h1>
    <br>
    <form method = 'get' action = '{!!url("items")!!}'>
        <button class = 'btn btn-primary'>item Index</button>
    </form>
    <br>
    <table class = 'table table-bordered'>
        <thead>
            <th>Key</th>
            <th>Value</th>
        </thead>
        <tbody>
            <tr>
                <td>
                    <b><i>name : </i></b>
                </td>
                <td>{!!$item->name!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>description : </i></b>
                </td>
                <td>{!!$item->description!!}</td>
            </tr>
        </tbody>
    </table>
</section>
@endsection