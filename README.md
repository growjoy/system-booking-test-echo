# 📅 Sistem Booking Real-Time dengan Laravel Echo

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-red.svg" alt="Laravel 12">
  <img src="https://img.shields.io/badge/PHP-8.2+-blue.svg" alt="PHP 8.2+">
  <img src="https://img.shields.io/badge/WebSocket-Reverb-green.svg" alt="Reverb">
  <img src="https://img.shields.io/badge/License-MIT-yellow.svg" alt="MIT License">
</p>

Sistem booking modern dengan pembaruan real-time menggunakan Laravel 12, Laravel Echo, dan Laravel Reverb. Aplikasi ini memungkinkan multiple users untuk melihat pembaruan booking secara langsung tanpa perlu refresh halaman.

## ✨ Fitur Utama

- 🔴 **Update Real-Time** - Semua perubahan langsung terlihat di semua pengguna
- 📊 **Dashboard Statistik** - Monitor total booking, pending, confirmed, dan cancelled
- 🎨 **UI Modern & Responsif** - Desain yang indah dan mobile-friendly
- ⚡ **Notifikasi Langsung** - Toast notification untuk setiap perubahan
- 🔍 **Filter Booking** - Filter berdasarkan status
- ✅ **Validasi Form** - Validasi client-side dan server-side
- 🎭 **Animasi Smooth** - Transisi dan efek visual yang menarik
- 📱 **Mobile Responsive** - Bekerja sempurna di semua device

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 12
- **WebSocket**: Laravel Reverb
- **Frontend**: Vanilla JavaScript + Laravel Echo
- **Real-time**: Pusher Protocol
- **Database**: MySQL
- **Build Tool**: Vite

## 📋 Prasyarat

Pastikan sistem Anda sudah terinstall:

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL atau database lainnya
- Git

## 🚀 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/username/booking-system.git
cd booking-system
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 3. Konfigurasi Environment

```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan dengan database Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=booking_system
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Konfigurasi Broadcasting

Pastikan konfigurasi broadcasting di `.env` sudah benar:

```env
BROADCAST_CONNECTION=reverb
QUEUE_CONNECTION=database

REVERB_APP_ID=my-app-id
REVERB_APP_KEY=my-app-key
REVERB_APP_SECRET=my-app-secret
REVERB_HOST="localhost"
REVERB_PORT=8080
REVERB_SCHEME=http

VITE_REVERB_APP_KEY="${REVERB_APP_KEY}"
VITE_REVERB_HOST="${REVERB_HOST}"
VITE_REVERB_PORT="${REVERB_PORT}"
VITE_REVERB_SCHEME="${REVERB_SCHEME}"
```

### 6. Migrasi Database

```bash
php artisan migrate
```

### 7. Build Assets

```bash
npm run build
# atau untuk development
npm run dev
```

## 🎯 Menjalankan Aplikasi

Anda memerlukan **4 terminal terpisah** untuk menjalankan aplikasi ini:

### Terminal 1: Laravel Server

```bash
php artisan serve
```

Server akan berjalan di `http://localhost:8000`

### Terminal 2: Reverb WebSocket Server

```bash
php artisan reverb:start --debug
```

WebSocket server akan berjalan di port `8080`

### Terminal 3: Vite Development Server

```bash
npm run dev
```

### Terminal 4: Queue Worker (Opsional)

```bash
php artisan queue:work
```

Untuk performa yang lebih baik, jalankan queue worker.

## 📖 Cara Menggunakan

### Membuat Booking Baru

1. Buka browser dan akses `http://localhost:8000`
2. Klik tombol **"+ New Booking"**
3. Isi formulir booking:
   - Nama Customer
   - Email
   - Nomor Telepon
   - Pilih Service
   - Tanggal Booking
   - Waktu Booking
   - Catatan (opsional)
4. Klik **"Create Booking"**

### Melihat Update Real-Time

1. Buka 2 atau lebih window browser
2. Akses `http://localhost:8000` di semua window
3. Buat booking baru di salah satu window
4. Lihat booking muncul secara otomatis di window lainnya! 🎉

### Mengubah Status Booking

Setiap booking card memiliki 3 tombol aksi:

- **✓ Confirm** - Ubah status menjadi confirmed
- **⟳ Pending** - Kembalikan ke status pending
- **✕ Cancel** - Batalkan booking

Semua perubahan status akan langsung terlihat di semua pengguna yang sedang online.

### Filter Booking

Gunakan tab filter di bagian atas untuk melihat booking berdasarkan status:

- **All** - Semua booking
- **Pending** - Booking yang menunggu konfirmasi
- **Confirmed** - Booking yang sudah dikonfirmasi
- **Cancelled** - Booking yang dibatalkan

## 📁 Struktur Project

```
booking-system/
├── app/
│   ├── Events/
│   │   ├── BookingCreated.php      # Event untuk booking baru
│   │   └── BookingUpdated.php      # Event untuk update booking
│   ├── Http/
│   │   └── Controllers/
│   │       └── BookingController.php
│   └── Models/
│       └── Booking.php
├── database/
│   └── migrations/
│       └── create_bookings_table.php
├── resources/
│   ├── js/
│   │   ├── app.js
│   │   └── bootstrap.js            # Konfigurasi Laravel Echo
│   └── views/
│       └── bookings/
│           ├── index.blade.php     # Dashboard utama
│           ├── create.blade.php    # Form booking
│           └── partials/
│               └── booking-card.blade.php
├── routes/
│   └── web.php
├── .env
├── composer.json
└── package.json
```

## 🔧 Konfigurasi Lanjutan

### Mengubah Port Reverb

Edit file `.env`:

```env
REVERB_PORT=9000  # Ganti dengan port yang diinginkan
```

Jangan lupa update `VITE_REVERB_PORT` juga.

### Menggunakan HTTPS

Untuk production dengan HTTPS:

```env
REVERB_SCHEME=https
VITE_REVERB_SCHEME=https
```

### Queue Configuration

Untuk performa lebih baik, gunakan Redis atau database untuk queue:

```env
QUEUE_CONNECTION=redis
```

## 🐛 Troubleshooting

### WebSocket Tidak Terkoneksi

1. Pastikan Reverb server berjalan:
   ```bash
   php artisan reverb:start --debug
   ```

2. Cek console browser (F12) untuk error

3. Pastikan port 8080 tidak digunakan aplikasi lain

4. Clear cache:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

### Booking Tidak Muncul Real-Time

1. Cek apakah `BroadcastServiceProvider` sudah diaktifkan
2. Pastikan `BROADCAST_CONNECTION=reverb` di `.env`
3. Restart semua service (Laravel, Reverb, Vite)

### Error Migration

```bash
# Drop semua table dan migrasi ulang
php artisan migrate:fresh
```

## 🎨 Kustomisasi

### Mengubah Warna Tema

Edit CSS di file `resources/views/bookings/index.blade.php`:

```css
background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
/* Ganti dengan warna pilihan Anda */
```

### Menambah Service Baru

Edit file `resources/views/bookings/create.blade.php`:

```html
<option value="Service Baru">Service Baru</option>
```

### Custom Notification

Edit fungsi `showNotification()` di file `index.blade.php` untuk mengubah tampilan notifikasi.

## 📚 API Endpoints

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/` | Dashboard utama |
| GET | `/bookings/create` | Form booking baru |
| POST | `/bookings` | Simpan booking baru |
| PATCH | `/bookings/{id}/status` | Update status booking |
| DELETE | `/bookings/{id}` | Hapus booking |

## 🔐 Keamanan

- CSRF Protection aktif di semua form
- Validasi input server-side dan client-side
- XSS Protection dengan Laravel's Blade templating
- SQL Injection protection dengan Eloquent ORM


<p align="center">
  <a href="#top">⬆️ Kembali ke atas</a>
</p>
