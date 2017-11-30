@extends('adminlte::page')
@section('title','Show')
@section('content')

    <div class="box box-primary">
        <div class="box-header">
            <h1>
                Show item
            </h1>
            <br>
            <form method = 'get' action = '{!!url("item")!!}'>
                <button class = 'btn btn-primary'>item Index</button>
            </form>
        </div>
        <div class="box-body">
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
                            <b><i>brand : </i></b>
                        </td>
                        <td>{!!$item->brand!!}</td>
                    </tr>
                    <tr>
                        <td>
                            <b><i>quantity : </i></b>
                        </td>
                        <td>{!!$item->quantity!!}</td>
                    </tr>
                    <tr>
                        <td>
                            <b><i>firsthour : </i></b>
                        </td>
                        <td>{!!$item->firsthour!!}</td>
                    </tr>
                    <tr>
                        <td>
                            <b><i>succeeding : </i></b>
                        </td>
                        <td>{!!$item->succeeding!!}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
