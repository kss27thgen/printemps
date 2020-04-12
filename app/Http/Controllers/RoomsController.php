<?php

namespace App\Http\Controllers;

use App\Message;
use App\Room;
use App\User;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index() {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    public function store(Request $request) {
        Room::create($request->all());
        return redirect()->back();
    }

    public function show(Room $room) {
        $rooms = Room::all();
        $users = User::all();

        $messages = $room->messages()->orderBy('created_at', 'DESC')->get();

        return view('rooms.show', compact('room', 'rooms', 'users', 'messages'));
    }






    public function destroy(Room $room) {
        $room->delete();
        return redirect()->back();
    }
}
