@extends('layouts.app2')

@section('content')
    <div>
        <h2 >{{$data['user']->name}}</h2>
    </div>
    <div>
        <ul class="list-group">
            <li class="list-group-item">
                Joined on {{$data['user']->created_at->format('M d,Y \a\t h:i a') }}
            </li>
            <li class="list-group-item panel-body">
                <table class="table-padding">
                    <style>
                        .table-padding td{
                            padding: 3px 8px;
                        }
                    </style>
                    <tr>
                        <td>Total Posts</td>
                        <td> {{$data['posts_count']}}</td>
                        @if($data['author'] && $data['posts_count'])
                            <td><a href="{{ url('/my-all-posts')}}">Show All</a></td>
                        @endif
                    </tr>


                </table>
            </li>
            <li class="list-group-item">
                Total Comments {{$data['comments_count']}}
            </li>
        </ul>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><h3>Latest Posts</h3></div>
        <div class="panel-body">
            @if(!empty($data['latest_posts']))
                @foreach($data['latest_posts'] as $latest_post)
                    <p>
                        <strong><a href="{{ url('/'.$latest_post->slug) }}">{{ $latest_post->title }}</a></strong>
                        <span class="well-sm">On {{ $latest_post->created_at->format('M d,Y \a\t h:i a') }}</span>
                    </p>
                @endforeach
            @else
                <p>You have not written any post till now.</p>
            @endif
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><h3>Latest Comments</h3></div>
        <div class="list-group">
            @if(!empty($data['latest_comments']))
                @foreach($data['latest_comments'] as $latest_comment)
                    <div class="list-group-item">
                        <p>{{ mb_substr($latest_comment->body,0,180) }}</p>
                        <p>On {{ $latest_comment->created_at->format('M d,Y \a\t h:i a') }}</p>
                        <p>On post <a href="{{ url('/'.$latest_comment->post->slug) }}">{{ $latest_comment->post->title }}</a></p>
                    </div>
                @endforeach
            @else
                <div class="list-group-item">
                    <p>You have not commented till now. Your latest 5 comments will be displayed here</p>
                </div>
            @endif
        </div>
    </div>
@endsection
