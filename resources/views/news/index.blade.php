@extends('adminlte::page')
@section('title','GLS | '.$title)
@section('content')

<div class="box box-primary" style="background-color: rgba(250,250,250,0.2);">
    <div class="box-header" style="background-color: white;">
        <h1>{!!$title!!}</h1>
        @include('search')
        <br>
        <a class="btn btn-primary" href = '{!!url("news")!!}/create'><i class="fa fa-plus fa-md" aria-hidden="true"></i>  Create News</a>
    </div>
    <div class="box-body"><br>
        <ul class="timeline">
            @foreach($news as $entry) 
                <li id="{!!$entry->id!!}">
                    @if($entry->type == "item-add")
                        <i class="fa fa-flask bg-green"></i>
                    @else
                        <i class="fa fa-newspaper-o bg-blue"></i>
                    @endif
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> {!!date('F j, Y g:i A', strtotime($entry->date_posted))!!}</span>
                        <span class="time"><i class="fa fa-user"></i> {!!$entry->name!!}</span>
                        <h3 class="timeline-header"><b>{!!$entry->title!!}</b></h3>

                        <div class="timeline-body">
                            {!!$entry->content!!}
                        </div>
                        <div class="timeline-footer">
                            <a href = '#' data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-xs' data-link = "/news/{!!$entry->id!!}/deleteMsg" ><i class="fa fa-trash-o" aria-hidden="true"></i>  Delete</a>
                            <a class = 'viewEdit btn btn-warning btn-xs' href = '/news/{!!$entry->id!!}/edit'><i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Edit</a>
                            <a class = 'viewShow btn btn-primary btn-xs' href = '/news/{!!$entry->id!!}'><i class="fa fa-info" aria-hidden="true"></i>  Info</a>
                        </div>
                    </div>
                </li>
            @endforeach
            <div class='text-center'>{!! $news->render() !!}</div>
            <li class="time-label"><i class="fa fa-asterisk bg-gray"></i></li>
        </ul>
    </div>
</div>
@endsection