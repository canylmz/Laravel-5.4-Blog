@extends('layouts.app2')
@section('content')

    <h1 class="page-header">
        @if(isset($title)) {!!$title!!} @else Posts @endif

    </h1>


    <!-- Blog Post -->
    @foreach($posts as $post)
        <h2>
            <a href="{{url('/'.$post->slug)}}">{{$post->title}}</a>
        </h2>
        <!-- Author -->
        <p class="lead">
            <a href="{{url('user/'.$post->users->id.'/posts')}}">{{$post->users->name}}</a> on
            {{$post->created_at->toFormattedDateString() }}<span class="btn-xs glyphicon glyphicon-time"></span>
        </p>
        <p>{{mb_substr($post->body,0,180)}}</p>
        <a class="btn btn-primary" href="{{url('/'.$post->slug)}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

        <hr>

        @endforeach

                <!-- Pager -->
        <ul class="pager">
            <li class="previous">
                <a href="{{$posts->previousPageUrl()}}">&larr; Older</a>
            </li>

            <li >
                {{$posts->render()}}
            </li>

            <li class="next">
                <a href="{{$posts->nextPageUrl()}}">Newer &rarr;</a>
            </li>
        </ul>


@endsection





