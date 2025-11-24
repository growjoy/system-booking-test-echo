<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>New Booking</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .container {
            max-width: 800px;
            width: 100%;
        }
        
        .form-container {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        
        .form-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .form-header h1 {
            color: #333;
            font-size: 32px;
            margin-bottom: 10px;
        }
        
        .form-header p {
            color: #666;
            font-size: 16px;
        }
        
        .back-link {
            display: inline-block;
            color: #667eea;
            text-decoration: none;
            margin-bottom: 20px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .back-link:hover {
            transform: translateX(-5px);
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        label {
            display: block;
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        label.required::after {
            content: " *";
            color: #ef4444;
        }
        
        input, select, textarea {
            width: 100%;
            padding: 14px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s;
            font-family: inherit;
        }
        
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        .error {
            color: #ef4444;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }
        
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }
        
        .btn {
            flex: 1;
            padding: 16px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .btn-primary:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }
        
        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        
        .btn-secondary {
            background: #f3f4f6;
            color: #333;
        }
        
        .btn-secondary:hover {
            background: #e5e7eb;
        }
        
        .success-message {
            background: #d1fae5;
            border: 2px solid #10b981;
            color: #065f46;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            display: none;
            animation: slideDown 0.5s ease-out;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .loading {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 3px solid #ffffff;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .form-container {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <a href="{{ route('bookings.index') }}" class="back-link">← Back to Dashboard</a>
            
            <div class="form-header">
                <h1>📝 Create New Booking</h1>
                <p>Fill in the details to create a new booking</p>
            </div>

            <div class="success-message" id="success-message">
                <strong>✓ Success!</strong> Your booking has been created and is now live on the dashboard.
            </div>

            <form id="booking-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="customer_name" class="required">Customer Name</label>
                        <input type="text" id="customer_name" name="customer_name" placeholder="John Doe">
                        <div class="error" id="error-customer_name"></div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="required">Email</label>
                        <input type="email" id="email" name="email" placeholder="john@example.com">
                        <div class="error" id="error-email"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="phone" class="required">Phone Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="+1234567890">
                        <div class="error" id="error-phone"></div>
                    </div>

                    <div class="form-group">
                        <label for="service" class="required">Service</label>
                        <select id="service" name="service">
                            <option value="">Select a service</option>
                            <option value="Haircut">Haircut</option>
                            <option value="Spa Treatment">Spa Treatment</option>
                            <option value="Massage">Massage</option>
                            <option value="Consultation">Consultation</option>
                            <option value="Dental Checkup">Dental Checkup</option>
                            <option value="General Appointment">General Appointment</option>
                        </select>
                        <div class="error" id="error-service"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="booking_date" class="required">Booking Date</label>
                        <input type="date" id="booking_date" name="booking_date" min="{{ date('Y-m-d') }}">
                        <div class="error" id="error-booking_date"></div>
                    </div>

                    <div class="form-group">
                        <label for="booking_time" class="required">Booking Time</label>
                        <input type="time" id="booking_time" name="booking_time">
                        <div class="error" id="error-booking_time"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="notes">Additional Notes</label>
                    <textarea id="notes" name="notes" placeholder="Any special requests or information..."></textarea>
                    <div class="error" id="error-notes"></div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('bookings.index') }}'">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit-btn">
                        Create Booking
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script type="module">
        // Setup CSRF token
        const token = document.querySelector('meta[name="csrf-token"]').content;
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token;

        const form = document.getElementById('booking-form');
        const submitBtn = document.getElementById('submit-btn');
        const successMessage = document.getElementById('success-message');

        // Set minimum date to today
        document.getElementById('booking_date').min = new Date().toISOString().split('T')[0];

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            // Clear previous errors
            document.querySelectorAll('.error').forEach(el => {
                el.style.display = 'none';
                el.textContent = '';
            });
            document.querySelectorAll('input, select, textarea').forEach(el => {
                el.style.borderColor = '#e5e7eb';
            });

            // Disable submit button
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="loading"></span> Creating...';

            // Get form data
            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());

            try {
                const response = await window.axios.post('{{ route("bookings.store") }}', data);
                
                if (response.data.success) {
                    // Show success message
                    successMessage.style.display = 'block';
                    
                    // Reset form
                    form.reset();
                    
                    // Scroll to top
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                    
                    // Redirect after 2 seconds
                    setTimeout(() => {
                        window.location.href = '{{ route("bookings.index") }}';
                    }, 2000);
                }
            } catch (error) {
                if (error.response && error.response.status === 422) {
                    // Validation errors
                    const errors = error.response.data.errors;
                    
                    for (const field in errors) {
                        const errorElement = document.getElementById(`error-${field}`);
                        const inputElement = document.getElementById(field);
                        
                        if (errorElement && inputElement) {
                            errorElement.textContent = errors[field][0];
                            errorElement.style.display = 'block';
                            inputElement.style.borderColor = '#ef4444';
                        }
                    }
                    
                    // Scroll to first error
                    const firstError = document.querySelector('.error[style*="display: block"]');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                } else {
                    alert('An error occurred. Please try again.');
                }
                
                // Re-enable submit button
                submitBtn.disabled = false;
                submitBtn.textContent = 'Create Booking';
            }
        });

        // Real-time validation
        form.querySelectorAll('input, select, textarea').forEach(input => {
            input.addEventListener('blur', () => {
                if (input.value.trim() === '' && input.hasAttribute('required')) {
                    const errorElement = document.getElementById(`error-${input.name}`);
                    if (errorElement) {
                        errorElement.textContent = 'This field is required';
                        errorElement.style.display = 'block';
                        input.style.borderColor = '#ef4444';
                    }
                } else {
                    const errorElement = document.getElementById(`error-${input.name}`);
                    if (errorElement) {
                        errorElement.style.display = 'none';
                        input.style.borderColor = '#e5e7eb';
                    }
                }
            });
        });
    </script>
</body>
</html>