<div class="booking-card" data-id="{{ $booking->id }}" data-status="{{ $booking->status }}">
    <div class="booking-header">
        <div class="booking-info">
            <h3>{{ $booking->customer_name }}</h3>
            <p>{{ $booking->email }} • {{ $booking->phone }}</p>
        </div>
        <span class="status-badge status-{{ $booking->status }}">{{ $booking->status }}</span>
    </div>
    
    <div class="booking-details">
        <div class="detail-item">
            <span class="detail-label">Service</span>
            <span class="detail-value">{{ $booking->service }}</span>
        </div>
        <div class="detail-item">
            <span class="detail-label">Date</span>
            <span class="detail-value">{{ $booking->booking_date->format('M d, Y') }}</span>
        </div>
        <div class="detail-item">
            <span class="detail-label">Time</span>
            <span class="detail-value">{{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}</span>
        </div>
        @if($booking->notes)
        <div class="detail-item" style="grid-column: 1/-1;">
            <span class="detail-label">Notes</span>
            <span class="detail-value">{{ $booking->notes }}</span>
        </div>
        @endif
    </div>
    
    <div class="booking-actions">
        <button class="btn btn-success" onclick="updateStatus({{ $booking->id }}, 'confirmed')">✓ Confirm</button>
        <button class="btn btn-warning" onclick="updateStatus({{ $booking->id }}, 'pending')">⟳ Pending</button>
        <button class="btn btn-danger" onclick="updateStatus({{ $booking->id }}, 'cancelled')">✕ Cancel</button>
    </div>
</div>