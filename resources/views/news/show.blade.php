@extends('adminlte::page')
@section('title','Show')
@section('content')

    <div class="box box-primary">
        <div class="box-header">
            <h1>
                Show News
            </h1>
            <br>
            <form method = 'get' action = '{!!url("news")!!}'>
                <button class = 'btn btn-primary'>News Index</button>
            </form>
        </div>
        <div class="box-body">
            <br>
            <table class = 'table table-bordered'>
                <thead>
                    <th style="width: 210px">Reporter's Name</th>
                    <th>News Content</th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <b><i>Reporter's Name : </i></b>
                        </td>
                        <td>{!!$news->name!!}</td>
                    </tr>
                    <tr>
                        <td>
                            <b><i>Content: </i></b>
                        </td>
                        <td>{!!$news->content!!}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection