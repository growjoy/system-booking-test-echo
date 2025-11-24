<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Booking System - Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .header {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header h1 {
            color: #333;
            font-size: 32px;
        }
        
        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .btn-success {
            background: #10b981;
            color: white;
            padding: 8px 16px;
            font-size: 14px;
        }
        
        .btn-danger {
            background: #ef4444;
            color: white;
            padding: 8px 16px;
            font-size: 14px;
        }
        
        .btn-warning {
            background: #f59e0b;
            color: white;
            padding: 8px 16px;
            font-size: 14px;
        }
        
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .stat-card h3 {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        
        .stat-card .number {
            font-size: 36px;
            font-weight: bold;
            color: #667eea;
        }
        
        .bookings-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .bookings-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e5e7eb;
        }
        
        .bookings-header h2 {
            color: #333;
            font-size: 24px;
        }
        
        .filter-tabs {
            display: flex;
            gap: 10px;
        }
        
        .tab {
            padding: 8px 20px;
            border: 2px solid #e5e7eb;
            background: white;
            border-radius: 20px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .tab.active {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }
        
        .bookings-grid {
            display: grid;
            gap: 20px;
        }
        
        .booking-card {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
            transition: all 0.3s;
            animation: slideIn 0.5s ease-out;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .booking-card.new-booking {
            animation: pulse 0.5s ease-in-out;
            border-color: #10b981;
            background: #f0fdf4;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.02); }
        }
        
        .booking-card:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        
        .booking-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 15px;
        }
        
        .booking-info h3 {
            color: #333;
            font-size: 20px;
            margin-bottom: 5px;
        }
        
        .booking-info p {
            color: #666;
            font-size: 14px;
        }
        
        .status-badge {
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }
        
        .status-confirmed {
            background: #d1fae5;
            color: #065f46;
        }
        
        .status-cancelled {
            background: #fee2e2;
            color: #991b1b;
        }
        
        .booking-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 15px;
            padding: 15px;
            background: #f9fafb;
            border-radius: 8px;
        }
        
        .detail-item {
            display: flex;
            flex-direction: column;
        }
        
        .detail-label {
            font-size: 12px;
            color: #666;
            margin-bottom: 4px;
            font-weight: 600;
        }
        
        .detail-value {
            font-size: 14px;
            color: #333;
        }
        
        .booking-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            max-width: 400px;
            z-index: 1000;
            animation: slideInRight 0.5s ease-out;
        }
        
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .notification.success {
            border-left: 4px solid #10b981;
        }
        
        .notification.info {
            border-left: 4px solid #3b82f6;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }
        
        .empty-state svg {
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
            opacity: 0.3;
        }
        
        .live-indicator {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            background: #fee2e2;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .live-dot {
            width: 8px;
            height: 8px;
            background: #ef4444;
            border-radius: 50%;
            animation: blink 1.5s infinite;
        }
        
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>📅 Booking System Dashboard</h1>
                <div class="live-indicator">
                    <span class="live-dot"></span>
                    <span>LIVE UPDATES</span>
                </div>
            </div>
            <a href="{{ route('bookings.create') }}" class="btn btn-primary">+ New Booking</a>
        </div>

        <div class="stats">
            <div class="stat-card">
                <h3>Total Bookings</h3>
                <div class="number" id="total-count">{{ $bookings->count() }}</div>
            </div>
            <div class="stat-card">
                <h3>Pending</h3>
                <div class="number" id="pending-count">{{ $bookings->where('status', 'pending')->count() }}</div>
            </div>
            <div class="stat-card">
                <h3>Confirmed</h3>
                <div class="number" id="confirmed-count">{{ $bookings->where('status', 'confirmed')->count() }}</div>
            </div>
            <div class="stat-card">
                <h3>Cancelled</h3>
                <div class="number" id="cancelled-count">{{ $bookings->where('status', 'cancelled')->count() }}</div>
            </div>
        </div>

        <div class="bookings-container">
            <div class="bookings-header">
                <h2>All Bookings</h2>
                <div class="filter-tabs">
                    <button class="tab active" data-filter="all">All</button>
                    <button class="tab" data-filter="pending">Pending</button>
                    <button class="tab" data-filter="confirmed">Confirmed</button>
                    <button class="tab" data-filter="cancelled">Cancelled</button>
                </div>
            </div>

            <div class="bookings-grid" id="bookings-grid">
                @forelse($bookings as $booking)
                    @include('bookings.partials.booking-card', ['booking' => $booking])
                @empty
                    <div class="empty-state">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <h3>No bookings yet</h3>
                        <p>Create your first booking to get started!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script type="module">
        // Setup CSRF token for AJAX requests
        const token = document.querySelector('meta[name="csrf-token"]').content;
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token;

        let currentFilter = 'all';

        // Filter functionality
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', () => {
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                currentFilter = tab.dataset.filter;
                filterBookings();
            });
        });

        function filterBookings() {
            const cards = document.querySelectorAll('.booking-card');
            cards.forEach(card => {
                if (currentFilter === 'all' || card.dataset.status === currentFilter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Show notification
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.innerHTML = `
                <strong>${type === 'success' ? '✅' : 'ℹ️'} ${type === 'success' ? 'Success!' : 'New Booking'}</strong>
                <p>${message}</p>
            `;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 300);
            }, 4000);
        }

        // Update statistics
        function updateStats() {
            const cards = document.querySelectorAll('.booking-card');
            const total = cards.length;
            const pending = document.querySelectorAll('.booking-card[data-status="pending"]').length;
            const confirmed = document.querySelectorAll('.booking-card[data-status="confirmed"]').length;
            const cancelled = document.querySelectorAll('.booking-card[data-status="cancelled"]').length;

            document.getElementById('total-count').textContent = total;
            document.getElementById('pending-count').textContent = pending;
            document.getElementById('confirmed-count').textContent = confirmed;
            document.getElementById('cancelled-count').textContent = cancelled;
        }

        // Listen for new bookings
        window.Echo.channel('bookings')
            .listen('BookingCreated', (e) => {
                console.log('New booking received:', e);
                
                const bookingCard = createBookingCard(e);
                const grid = document.getElementById('bookings-grid');
                
                // Remove empty state if exists
                const emptyState = grid.querySelector('.empty-state');
                if (emptyState) {
                    emptyState.remove();
                }
                
                // Add new booking at the top
                grid.insertAdjacentHTML('afterbegin', bookingCard);
                
                // Add new-booking class for animation
                const newCard = grid.firstElementChild;
                newCard.classList.add('new-booking');
                setTimeout(() => newCard.classList.remove('new-booking'), 2000);
                
                updateStats();
                filterBookings();
                showNotification(`New booking from ${e.customer_name}`, 'info');
            })
            .listen('BookingUpdated', (e) => {
                console.log('Booking updated:', e);
                
                const card = document.querySelector(`.booking-card[data-id="${e.id}"]`);
                if (card) {
                    const statusBadge = card.querySelector('.status-badge');
                    statusBadge.className = `status-badge status-${e.status}`;
                    statusBadge.textContent = e.status;
                    card.dataset.status = e.status;
                    
                    updateStats();
                    filterBookings();
                    showNotification(`Booking #${e.id} status updated to ${e.status}`, 'success');
                }
            });

        // Create booking card HTML
        function createBookingCard(booking) {
            return `
                <div class="booking-card" data-id="${booking.id}" data-status="${booking.status}">
                    <div class="booking-header">
                        <div class="booking-info">
                            <h3>${booking.customer_name}</h3>
                            <p>${booking.email} • ${booking.phone}</p>
                        </div>
                        <span class="status-badge status-${booking.status}">${booking.status}</span>
                    </div>
                    <div class="booking-details">
                        <div class="detail-item">
                            <span class="detail-label">Service</span>
                            <span class="detail-value">${booking.service}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Date</span>
                            <span class="detail-value">${booking.booking_date}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Time</span>
                            <span class="detail-value">${booking.booking_time}</span>
                        </div>
                        ${booking.notes ? `
                        <div class="detail-item" style="grid-column: 1/-1;">
                            <span class="detail-label">Notes</span>
                            <span class="detail-value">${booking.notes}</span>
                        </div>
                        ` : ''}
                    </div>
                    <div class="booking-actions">
                        <button class="btn btn-success" onclick="updateStatus(${booking.id}, 'confirmed')">✓ Confirm</button>
                        <button class="btn btn-warning" onclick="updateStatus(${booking.id}, 'pending')">⟳ Pending</button>
                        <button class="btn btn-danger" onclick="updateStatus(${booking.id}, 'cancelled')">✕ Cancel</button>
                    </div>
                </div>
            `;
        }

        // Update booking status
        window.updateStatus = async function(id, status) {
            try {
                const response = await window.axios.patch(`/bookings/${id}/status`, { status });
                // The real-time update will handle the UI change
            } catch (error) {
                console.error('Error updating status:', error);
                alert('Failed to update booking status');
            }
        };
    </script>
</body>
</html>