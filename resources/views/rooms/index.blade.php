@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Make Room</div>

                <div class="card-body">
                    <form action="{{ route('rooms.store') }}" method="POST" class="d-flex">
                        @csrf
                        <input type="text" name="name" class="form-control">
                        <button class="btn btn-success">Make</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-header">Rooms</div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($rooms as $room)
                            <li class="list-group-item">
                                <a href="{{ route('rooms.show', $room) }}" class="d-flex justify-content-between align-items-center">
                                    <p class="mb-0" style="font-size:2rem;">{{ $room->name }}</p>
                                    <form action="{{ route('rooms.destroy', $room) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">DEL</button>
                                    </form>
                                </a>
                            </li>    
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
