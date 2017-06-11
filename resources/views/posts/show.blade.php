@extends('layouts.app2')
@section('content')


        <!-- Blog Post Content Column -->

        @foreach($posts as $post)
             <!-- Blog Post -->

            <!-- Title -->
            <h1 >{{$post->title}}</h1>
            @if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->isAdmin()))
                <button class="btn" style="float: right"><a href="{{ url('edit/'.$post->slug)}}">Edit Post</a></button>
                @endif
            <!-- Author -->
                <p class="lead">
                     <a href="{{url('user/'.$post->users->id.'/posts')}}">{{$post->users->name}}</a> on
                    {{$post->created_at->toFormattedDateString() }}<span class="btn-xs glyphicon glyphicon-time"></span>
                </p>
            <hr>

                <!-- Post Content -->
                <p class="lead">{{$post->body}}</p>

        @endforeach
        <hr>

    <!-- Blog Comments -->

    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>
        <form role="form" method="POST" action="{{url('/posts/'.$post->id.'/comments')}}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">

                    <textarea id="body" rows="3" class="form-control" name="body" required autofocus placeholder="Comment here.">{{ old('body') }}</textarea>

                    @if ($errors->has('body'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                    @endif

            </div>
            <div class="form-group">

            <button type="submit" class="btn btn-primary">Submit</button>

            </div>
        </form>
    </div>

    <hr>

    <!-- Posted Comments -->

    <!-- Comment -->
        @foreach($post->comments as $comment)
            <div class="media">
                <a class="pull-left" href="{{url('user/'.$comment->users->id.'/posts')}}">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$comment->users->name}}
                        <small>{{$comment->created_at->diffForHumans()}}</small>
                    </h4>
                {{$comment->body}}
                </div>
            </div>
            @endforeach


    @endsection


