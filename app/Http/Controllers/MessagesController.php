<?php

namespace App\Http\Controllers;

use App\Events\MessageCreated;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MessagesController extends Controller
{
    public function index() {

    }

    public function store(Request $request, $room) {
        $data = $request->all();

        if ($request->image) {
            $image = $request->file('image');
            $path = Storage::disk('s3')->putFile('images', $image, 'public');
            $data['image'] = Storage::disk('s3')->url($path);
        }

        $data['user_id'] = Auth::id();
        $data['room_id'] = $room;
        $message = Message::create($data);

        $user = Auth::user();
        event(new MessageCreated($message, $user));

        return redirect()->back();
    }
}
