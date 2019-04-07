@extends('layouts.app')

@section('content')

    <div class="content">
        <ul>
            @foreach($posts as $post)
                <li>{{ $loop->iteration }}.- {{ $post->title }}</li>
            @endforeach
        </ul>
        {{ $posts->render() }}
    </div>

@endsection