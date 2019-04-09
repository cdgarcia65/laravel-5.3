@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <ul class="list-group">
            @foreach ($notifications as $notification) 
                <li class="list-group-item" @if ($notification->is_new) style="font-weight: bold;" @endif>
                    <a href="{{ $notification->url }}">
                        {{ $notification->description }}
                    </a>
                    <br> <em>{{ $notification->date }}</em>
                </li>
            @endforeach
            </ul>

            <p>
                <a href="{{ url('notifications/read-all') }}">Mark all as read</a>
            </p>
        </div>
    </div>

@endsection