@if(auth()->user()->rol === "administrador")
    @if(request()->routeIs('hotels.create'))
        <nav>
            <a href="{{ route('rooms.checkInList') }}" class="check-in-link">Check-in Habitacions</a>
        </nav>
    @endif
@endif
