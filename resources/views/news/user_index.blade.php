@extends('adminlte::page_user')
@section('title','Index')
@section('content')

<div class="box box-primary" style="background-color: rgba(250,250,250,0.2);">
    <div class="box-header" style="background-color: white;">
        <h1>News Index</h1>
        @include('search')
        <br>
    </div>
    <div class="box-body"><br>
        <ul class="timeline">
            @foreach($news as $entry) 
                <li id="{!!$entry->id!!}">
                        <i class="fa fa-newspaper-o bg-blue"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> {!!date('F j, Y g:i A', strtotime($entry->date_posted))!!}</span>
                        <span class="time"><i class="fa fa-user"></i> {!!$entry->name!!}</span>
                        <h3 class="timeline-header"><b>{!!$entry->title!!}</b></h3>

                        <div class="timeline-body">
                            {!!$entry->content!!}
                        </div>
                        <div class="timeline-footer">
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