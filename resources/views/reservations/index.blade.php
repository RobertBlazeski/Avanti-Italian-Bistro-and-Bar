@extends('layouts.master')

@section('content')
<div class="reservation-container">
    <h1 class="reservation-header">My Reservations</h1>

    @if(session('success'))
        <div class="reservation-alert reservation-alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($reservations->isEmpty())
        <div class="reservation-empty-state">
            <p>You have no reservations yet.</p>
        </div>
    @else
        <div class="reservation-list">
            @foreach($reservations as $reservation)
                <div class="reservation-item {{ $reservation->status == 'cancelled' ? 'reservation-item-cancelled' : '' }}">
                    <div class="reservation-item-content">
                        <div class="reservation-details">
                            <h2 class="reservation-title">
                                Reservation for {{ $reservation->guests }} guests
                            </h2>
                            <div class="reservation-info">
                                <p>
                                    <span class="reservation-label">Date:</span> 
                                    {{ $reservation->datetime->format('F d, Y H:i') }}
                                </p>
                                <p>
                                    <span class="reservation-label">Class:</span> 
                                    {{ ucfirst($reservation->class) }}
                                </p>
                                <p>
                                    <span class="reservation-label">Status:</span>
                                    <span class="{{ 
                                        $reservation->status == 'pending' ? 'reservation-status-pending' : 
                                        ($reservation->status == 'confirmed' ? 'reservation-status-confirmed' : 'reservation-status-cancelled')
                                    }}">
                                        {{ ucfirst($reservation->status) }}
                                    </span>
                                </p>
                            </div>
                        </div>

                        @if($reservation->status == 'pending')
                            <form action="{{ route('reservations.cancel', $reservation) }}" method="POST" class="reservation-cancel-form">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="reservation-cancel-button">
                                    Cancel Reservation
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
body {
    background-color: #1a1a1a;
    color: #f4f4f4;
    font-family: 'Montserrat', 'Arial', sans-serif;
}

</style>
@endsection