@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Profile</div>
                <div class="panel-body">
                    <form action="{{ url('profile') }}" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('nickname') ? ' has-error' : ''}}">
                            <label for="nickname" class="col-md-4 control-label">Nickname</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="nickname" id="nickname" value="{{ old('nickname', $profile->nickname) }}">
                                @if ($errors->has('nickname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nickname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('featured_post_id') ? ' has-error' : ''}}">
                            <label for="featured_post_id" class="col-md-4 control-label">Featured post:</label>

                            <div class="col-md-6">

                                <select name="featured_post_id" class="form-control" id="featured_post_id">
                                    <option value="">Seleccione uno</option>
                                    @foreach($posts as $post)
                                    <option value="{{ $post->id }}" {{ $post->id == old('featured_post_id', $profile->featured_post_id) }}>
                                        {{ $post->title }} - {{ $post->points }}
                                    </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('featured_post_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('featured_post_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : ''}}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea name="description" id="description" class="form-control">{{ old('description', $profile->description) }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                        
                        @if ($profile->avatar)
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <img src="{{ url('profile/avatar') }}" alt="avatar">
                                </div>
                            </div>
                        @endif

                        <div class="form-group{{ $errors->has('avatar') ? ' has-error' : ''}}">
                            <label for="avatar" class="col-md-4 control-label">Avatar</label>

                            <div class="col-md-6">
                                <input type="file" name="avatar" id="avatar">
                            </div>
                            <br>

                            @if ($errors->has('avatar'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('avatar') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update profile
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection