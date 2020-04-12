<div class="mt-5 p-3">
    <p class="mt-5 mb-1" style="font-size:1.4rem;">Rooms</p>
    <ul class="list-group">
        @foreach ($rooms as $room)
            <li class="list-group-item">
                <a href="{{ route('rooms.show', $room) }}">
                    <h5>
                        {{ $room->name }}
                    </h5>
                </a>
                @if ($room->messages->last())
                    @if ($room->messages->last()->text)
                        <p class="mb-0">
                            {{ $room->messages->last()->text }}
                        </p>
                    @else
                        <p class="mb-0">
                            - image &boxbox;
                        </p>
                    @endif
                @else
                    <p class="mb-0">- No post yet</p>
                @endif
            </li>
        @endforeach
    </ul>
</div>