@extends('layouts.main')

@section('content')
    <div class="mt-3">
        <h3 class="display-4 text-center">- {{ $room->name }} -</h3>
        <form method="POST" action="{{ route('messages.store', $room) }}" class="d-flex" enctype="multipart/form-data" id="main-form">
            @csrf
            <input type="text" name="text" class="form-control" style="font-size:2rem;" placeholder="say something...">
            <input type="file" name="image" id="image" hidden>
            <label for="image" class="btn btn-success" style="font-size:2rem;">FILE</label>
        </form>
        <p id="form-status"></p>
        <div class="row mt-3">
            <div class="col-9">
                <ul class="list-group" id="message-list">
                    @foreach ($messages as $message)
                        <li class="list-group-item">
                            <div>
                                <p class="font-weight-bold mb-0">{{ $message->user->name }}
                                    <span class="ml-1 font-weight-light">({{ $message->created_at->diffForHumans() }})</span>
                                </p>
                            </div>
                            <p class="mb-0" style="font-size:1.5rem;">{{ $message->text }}</p>
                            @if ($message->image)
                                <p class="mb-0 mt-1">
                                    <a href="{{ $message->image }}" target="_blank">
                                        <img class="chat-image" src="{{ $message->image }}">
                                    </a>
                                </p>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-3">
                <p class="mb-1" style="font-size:1.4rem;">
                    Users
                </p>
                <p class="ml-1 text-primary">
                    &block;
                    <span class="text-black-50"> - active</span>
                </p>
                <ul class="list-group" id="user-list">
                    @foreach ($users as $user)
                        <li class="list-group-item user-list-item" data-id="{{ $user->id }}">
                            {{ $user->name }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    
@endsection

