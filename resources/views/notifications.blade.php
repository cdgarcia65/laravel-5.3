@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <ul class="list-group">
            @foreach ($notifications as $notification) 
                <li class="list-group-item" @if ($notification->read_at == null) style="font-weight: bold;" @endif>
                    <a href="{{ url("notifications/$notification->id") }}">
                        {{ trans('notifications.' . snake_case(class_basename($notification->type), '-'), $notification->data) }}
                    </a>
                    <br> <em>{{ $notification->created_at->format('d/m/Y H:i:a') }}</em>
                </li>
            @endforeach
            </ul>

            <p>
                <a href="{{ url('notifications/read-all') }}">Mark all as read</a>
            </p>
        </div>
    </div>

@endsection