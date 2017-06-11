@extends('layouts.app2')
@section('content')

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Publish at Post</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url("/update") }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="post_id" value="{{ $post->id }}{{ old('post_id') }}">
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="@if(!old('title')){{$post->title}}@endif{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                            <label for="body" class="col-md-4 control-label">Body</label>

                            <div class="col-md-6">
                                <textarea id="body"  rows="5" class="form-control" name="body" required>@if(!old('body')){!! $post->body !!}@endif{!! old('body') !!}</textarea>
                                @if ($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-1 col-md-offset-4">
                                <input type="submit" name='publish' class="btn btn-success" value = "Update"/>
                            </div>

                            <div class="col-md-1 col-md-offset-3">
                                <a href="{{  url('delete/'.$post->id.'?_token='.csrf_token()) }}" class="btn btn-danger">Delete</a>
                            </div>



                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @endsection