@extends('adminlte::page_user')
@section('title','GLS | '.$title)
@section('content')

<div class="box box-primary" style="background-color: rgba(250,250,250,0.2);">
    <div class="box-header" style="background-color: white;">
        <h1>{!!$title!!}</h1>
    </div>
    <div class="box-body">
        <ul class="timeline">
            @foreach($news as $entry) 
                <li id="{!!$entry->id!!}">
                    @if($entry->type == "item-add")
                        <i data-toggle="tooltip" title="New Item" class="fa fa-flask bg-green"></i>
                    @else
                        <i data-toggle="tooltip" title="Information" class="fa fa-newspaper-o bg-blue"></i>
                    @endif
                    <div class="timeline-item">
                        <span data-toggle="tooltip" title="Date Posted" class="time"><i class="fa fa-clock-o"></i> {!!date('F j, Y g:i A', strtotime($entry->date_posted))!!}</span>
                        <span data-toggle="tooltip" title="Posted by" class="time"><i class="fa fa-user"></i> {!!$entry->name!!}</span>
                        <h3 class="timeline-header"><b>{!!$entry->title!!}</b></h3>

                        <div class="timeline-body">
                            {!!$entry->content!!}
                        </div>
                        <div class="timeline-footer">
                        </div>
                    </div>
                </li>
            @endforeach
            <li class="time-label"><i class="fa fa-asterisk bg-gray"></i></li>
        </ul>
    </div>
</div>
@endsection