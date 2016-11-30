@extends('scaffold-interface.layouts.app')
@section('title','Index')
@section('content')

<section class="content">
    <h1>
        Item Index
    </h1>
    <br>
    <br>
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th>name</th>
            <th>description</th>
        </thead>
        <tbody>
            @foreach($items as $item) 
            <tr>
                <td>{!!$item->name!!}</td>
                <td>{!!$item->description!!}</td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    {!! $items->render() !!}

</section>
@endsection