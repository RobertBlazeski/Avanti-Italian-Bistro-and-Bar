<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\RestaurantTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        // Validate reservation details
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'guests' => 'required|integer|min:1|max:12',
            'datetime' => 'required|date|after:now|before:+3 months',
            'duration' => 'required|integer|min:1|max:4', // Add duration (1-4 hours)
            'class' => 'required|in:budget,second,first',
        ]);

        // Check for large group
        if ($request->guests > 12) {
            return back()->with('large_group_message', 'For groups larger than 12, please contact us directly at 077 705 850 or via our Contact Us page.');
        }
        

        // Parse start and end times
        $startTime = Carbon::parse($validatedData['datetime']);
        $duration = (int) $validatedData['duration']; 
        $endTime = $startTime->copy()->addHours($duration);


        // Find an available table (no overlapping reservations)
        $availableTable = RestaurantTable::where('class', $validatedData['class'])
            ->where('capacity', '>=', $validatedData['guests'])
            ->whereDoesntHave('reservations', function ($query) use ($startTime, $endTime) {
                $query->where(function ($q) use ($startTime, $endTime) {
                    $q->whereBetween('datetime', [$startTime, $endTime])
                      ->orWhereBetween(
                          DB::raw('DATE_ADD(datetime, INTERVAL duration HOUR)'), 
                          [$startTime, $endTime]
                      );
                });
            })
            ->first();

        // Create reservation
        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'restaurant_table_id' => $availableTable ? $availableTable->id : null,
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'guests' => $validatedData['guests'],
            'datetime' => $validatedData['datetime'],
            'duration' => $validatedData['duration'], // Save duration
            'class' => $validatedData['class'],
            'status' => $availableTable ? 'pending' : 'cancelled',
        ]);

        // Update table status if a table was found
        if ($availableTable) {
            $availableTable->update(['status' => 'pending']);
        }

        // Redirect with success message
        return redirect()->route('reservations.index')
            ->with('success', $availableTable
                ? 'Reservation created successfully. We will confirm your booking soon.'
                : 'No available tables for the selected time and duration. Please try a different time or duration.'
            );
    }

    public function index()
    {
        // Fetch reservations for the authenticated user
        $reservations = Auth::user()->reservations()->latest()->get();
        return view('reservations.index', compact('reservations'));
    }

    public function cancel(Reservation $reservation)
    {
        // Ensure user can only cancel their own reservations
        if ($reservation->user_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        // Update reservation status
        $reservation->update(['status' => 'cancelled']);

        // Free up the table if it was assigned
        if ($reservation->restaurant_table_id) {
            RestaurantTable::find($reservation->restaurant_table_id)
                ->update(['status' => 'free']);
        }

        return back()->with('success', 'Reservation cancelled successfully.');
    }


    //owner functions

    public function ownerIndex()
{
    // Fetch all reservations, ordered by most recent first
    $reservations = Reservation::latest()->get();
    return view('owner.reservations.index', compact('reservations'));
}
public function approve(Reservation $reservation)
{
    // Ensure only the owner can approve
    if (!Auth::user()->isOwner()) {
        return back()->with('error', 'Unauthorized action.');
    }

    // Update reservation status
    $reservation->update(['status' => 'confirmed']);

    // Confirm the table assignment
    if ($reservation->restaurant_table_id) {
        RestaurantTable::find($reservation->restaurant_table_id)
            ->update(['status' => 'confirmed']);
    }

    return back()->with('success', 'Reservation confirmed successfully.');
}

public function decline(Reservation $reservation)
{
    // Ensure only the owner can decline
    if (!Auth::user()->isOwner()) {
        return back()->with('error', 'Unauthorized action.');
    }

    // Update reservation status
    $reservation->update(['status' => 'cancelled']);

    // Free up the table if it was assigned
    if ($reservation->restaurant_table_id) {
        RestaurantTable::find($reservation->restaurant_table_id)
            ->update(['status' => 'pending']);
    }

    return back()->with('success', 'Reservation declined successfully.');
}
}
