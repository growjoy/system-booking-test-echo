<?php

namespace App\Events;

use App\Models\Booking;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookingUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Booking $booking)
    {
    }

    public function broadcastOn(): Channel
    {
        return new Channel('bookings');
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->booking->id,
            'customer_name' => $this->booking->customer_name,
            'email' => $this->booking->email,
            'phone' => $this->booking->phone,
            'booking_date' => $this->booking->booking_date->format('Y-m-d'),
            'booking_time' => $this->booking->booking_time,
            'service' => $this->booking->service,
            'status' => $this->booking->status,
            'notes' => $this->booking->notes,
        ];
    }
}