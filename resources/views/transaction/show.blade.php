@extends('scaffold-interface.layouts.app')
@section('title','Show')
@section('content')

<section class="content">
    <h1>
        Show transaction
    </h1>
    <br>
    <form method = 'get' action = '{!!url("transaction")!!}'>
        <button class = 'btn btn-primary'>transaction Index</button>
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
                    <b><i>cart_id : </i></b>
                </td>
                <td>{!!$transaction->cart_id!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>submitted_at : </i></b>
                </td>
                <td>{!!$transaction->submitted_at!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>disbursed_at : </i></b>
                </td>
                <td>{!!$transaction->disbursed_at!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>completed_at : </i></b>
                </td>
                <td>{!!$transaction->completed_at!!}</td>
            </tr>
        </tbody>
    </table>
</section>
@endsection