@extends('adminlte::page_user')
@section('title','GLS | '.$title)
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
                    <b><i>Name : </i></b>
                </td>
                <td>{!!$item->name!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>Brand : </i></b>
                </td>
                <td>{!!$item->brand!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>Description : </i></b>
                </td>
                <td>{!!$item->description!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>Quantity : </i></b>
                </td>
                <td>{!!$item->quantity!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>Acquisition Cost : </i></b>
                </td>
                <td>PHP {!!$item->acquisitioncost!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>Charge for the First hour of use : </i></b>
                </td>
                <td>PHP {!!$item->firsthour!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>Charge for the succeding hours of use: </i></b>
                </td>
                <td>PHP {!!$item->succeeding!!}</td>
            </tr>
        </tbody>
    </table>
    <br/>
</div>
</div>

@endsection