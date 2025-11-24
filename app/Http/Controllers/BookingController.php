<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Events\BookingCreated;
use App\Events\BookingUpdated;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::orderBy('booking_date', 'desc')
                          ->orderBy('booking_time', 'desc')
                          ->get();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        return view('bookings.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required',
            'service' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $booking = Booking::create($validated);

        // Broadcast the event
        broadcast(new BookingCreated($booking));

        return response()->json([
            'success' => true,
            'message' => 'Booking created successfully!',
            'booking' => $booking
        ]);
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $booking->update($validated);

        // Broadcast the event
        broadcast(new BookingUpdated($booking));

        return response()->json([
            'success' => true,
            'message' => 'Booking status updated!',
            'booking' => $booking
        ]);
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return response()->json([
            'success' => true,
            'message' => 'Booking deleted successfully!'
        ]);
    }
}