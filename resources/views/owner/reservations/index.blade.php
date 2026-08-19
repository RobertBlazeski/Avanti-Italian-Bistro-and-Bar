@extends('layouts.master')

@section('content')
<div class="container-dark">
    <h1 class="text-gold border-bottom border-gold pb-3 mb-4">Reservations Management</h1>

    @if(session('success'))
        <div class="alert alert-success text-gold bg-dark">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-dark">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Guests</th>
                <th>Date & Time</th>
                <th>Duration</th>
                <th>Class</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
            <tr>
                <td>{{ $reservation->name }}</td>
                <td>{{ $reservation->email }}</td>
                <td>{{ $reservation->phone }}</td>
                <td>{{ $reservation->guests }}</td>
                <td>{{ $reservation->datetime }}</td>
                <td>{{ $reservation->duration }} hours</td>
                <td>{{ ucfirst($reservation->class) }}</td>
                <td>{{ ucfirst($reservation->status) }}</td>
                <td>
                    @if($reservation->status === 'pending')
                        <form action="{{ route('owner.reservations.approve', $reservation) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-gold">Approve</button>
                        </form>
                        <form action="{{ route('owner.reservations.decline', $reservation) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger">Decline</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection