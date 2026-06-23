# 🚀 Panduan Instalasi Exitem — Lengkap & Mudah

Selamat datang di project **Exitem**! Dokumen ini dirancang untuk membantu Anda menjalankan project ini di komputer lokal dengan langkah-langkah yang jelas, detail, dan anti-gagal.

---

## 📋 Prasyarat Sistem

Sebelum memulai, pastikan komputer Anda sudah terinstal:

1.  **PHP 8.3 atau lebih baru** (Project ini menggunakan PHP 8.3.31)
2.  **Composer** (Package Manager PHP)
3.  **Node.js 18.x & npm** (Untuk aset frontend)
4.  **MySQL 8.0** (Database)
5.  **ngrok** (Optional - untuk testing payment gateway)

---

## 🔧 Teknologi & Integrasi yang Digunakan

Project ini menggunakan teknologi modern dan terintegrasi dengan berbagai layanan:

### Framework & Library
- **Laravel 12.62.0** - PHP Framework
- **Livewire 4.3.1** - Reactive Components
- **Filament 5.6.7** - Admin Panel
- **Tailwind CSS** - Styling
- **Alpine.js** - JavaScript interactions

### Payment Gateway
- **Midtrans** - Payment gateway untuk transaksi
  - Menggunakan Midtrans Snap untuk checkout
  - Support multiple payment methods
  - Webhook untuk update status payment

### Real-time Features
- **Laravel Reverb** - WebSocket server untuk real-time updates
- **Laravel Echo** - Broadcasting events ke client

### Security Implementation
- **OWASP Top 10 Security** principles
- Rate limiting (5 attempts/60s untuk login & signup)
- Strong password policy (min 8 char, uppercase, lowercase, number)
- XSS protection dengan input sanitization
- CSRF protection
- Security headers (X-Frame-Options, X-XSS-Protection, dll)

---

## 🛠️ Langkah-Langkah Instalasi

Ikuti urutan langkah di bawah ini secara berurutan:

### 1. Clone Project
Download source code project ini ke komputer Anda:
```bash
git clone <url-repository> exitem
cd exitem
```

### 2. Install Dependency PHP
Unduh semua library yang dibutuhkan aplikasi:
```bash
composer install
```

### 3. Konfigurasi Environment
Salin file contoh konfigurasi menjadi file `.env`:
```bash
cp .env.example .env
```
*Untuk Windows (CMD): `copy .env.example .env`*

### 4. Generate Application Key
Wajib dilakukan untuk keamanan enkripsi aplikasi:
```bash
php artisan key:generate
```

### 5. Konfigurasi Database
1.  Buat database baru di MySQL (via phpMyAdmin atau terminal) dengan nama: `exitem`.
2.  Buka file `.env` di text editor (VS Code, dll).
3.  Cari bagian database dan sesuaikan dengan setting komputer Anda:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=localhost
    DB_PORT=3306
    DB_DATABASE=exitem
    DB_USERNAME=root
    DB_PASSWORD=p455w0rd      # Sesuaikan dengan password MySQL Anda
    ```

### 6. Konfigurasi Midtrans (Payment Gateway)

1. **Daftar Akun Midtrans:**
   - Kunjungi [https://dashboard.midtrans.com/register](https://dashboard.midtrans.com/register)
   - Pilih mode **Sandbox** (untuk testing)

2. **Dapatkan Credentials:**
   - Login ke Dashboard Midtrans
   - Masuk ke **Settings → Access Keys**
   - Copy **Server Key** dan **Client Key**

3. **Konfigurasi di `.env`:**
   ```env
   MIDTRANS_SERVER_KEY=SB-Mid-server-xxxxxxxxxxxxxx
   MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxxxxxxxxxxxx
   MIDTRANS_IS_PRODUCTION=false
   MIDTRANS_IS_SANITIZED=true
   MIDTRANS_IS_3DS=true
   ```

### 7. Setup ngrok (Untuk Webhook Midtrans)

Midtrans perlu mengirim notifikasi ke aplikasi Anda via webhook. Untuk development lokal, gunakan ngrok:

1. **Install ngrok:**
   - Download dari [https://ngrok.com/download](https://ngrok.com/download)
   - Extract dan jalankan

2. **Jalankan ngrok:**
   ```bash
   ngrok http 8000
   ```

3. **Copy URL ngrok:**
   - Anda akan mendapat URL seperti: `https://xxxx-xx-xxx-xxx-xx.ngrok-free.app`
   - Update `APP_URL` di `.env`:
   ```env
   APP_URL=https://xxxx-xx-xxx-xxx-xx.ngrok-free.app
   ```

4. **Konfigurasi Webhook di Midtrans:**
   - Login ke Dashboard Midtrans
   - Masuk ke **Settings → Configuration**
   - Set **Payment Notification URL** ke:
     ```
     https://xxxx-xx-xxx-xxx-xx.ngrok-free.app/midtrans/webhook
     ```

### 8. Konfigurasi Mail (Optional - untuk fitur email)
Untuk testing, gunakan log driver:
```env
MAIL_MAILER=log
MAIL_FROM_ADDRESS="noreply@exitem.com"
MAIL_FROM_NAME="${APP_NAME}"
```
Email akan tersimpan di `storage/logs/laravel.log`

### 9. Migrasi & Seeding Database
Membuat struktur tabel dan mengisi data awal (termasuk akun admin):
```bash
php artisan migrate --seed
```

### 10. Install Dependency Frontend
Unduh library untuk tampilan (Tailwind, Vite, Echo):
```bash
npm install
```

### 11. Build Assets
Kompilasi file CSS dan JavaScript:
```bash
npm run build
```

### 12. Hubungkan Folder Storage
Agar gambar produk dan banner bisa tampil di browser:
```bash
php artisan storage:link
```

---

## ⚡ Cara Menjalankan Aplikasi

Project ini telah dikonfigurasi agar Anda bisa menjalankan semuanya (Server, Vite, WebSocket Reverb, dan Queue) hanya dengan **satu perintah saja**.

Cukup jalankan:
```bash
composer run dev
```

Atau manual:
```bash
php artisan serve
```

*Sekarang, aplikasi Anda sudah berjalan sepenuhnya di:* `http://localhost:8000`

> **Catatan:** Jika menggunakan Midtrans, pastikan ngrok juga berjalan di terminal terpisah.

---

## 🔐 Akses Admin Panel

Panel Admin digunakan untuk mengelola produk, kategori, banner, transaksi, dan customers.

*   **URL**: `http://localhost:8000/admin`
*   **Email**: `admin@admin.com`
*   **Password**: `Miawmiawmiaw`

### Fitur Admin Panel:
- ✅ Manage Products & Categories
- ✅ Manage Brands
- ✅ Manage Banners (Hero slider)
- ✅ Manage Transactions
- ✅ Manage Customers
- ✅ Manage Team Members
- ✅ Manage Reviews
- ✅ Site Settings (About page, contact info)

> **Catatan:** Fitur registrasi di halaman admin telah dinonaktifkan demi keamanan. Gunakan akun di atas untuk masuk.

---

## 💳 Testing Payment (Midtrans Sandbox)

Untuk testing transaksi, gunakan kartu kredit dummy Midtrans:

| Card Number | CVV | Exp Date | Result |
|-------------|-----|----------|--------|
| 4811 1111 1111 1114 | 123 | 01/25 | Success |
| 4911 1111 1111 1113 | 123 | 01/25 | Pending |
| 4411 1111 1111 1118 | 123 | 01/25 | Failed |

Atau gunakan metode pembayaran lain:
- **GoPay:** 0812-3456-7890 / PIN: 123456
- **QRIS:** Scan QR dan klik "Pay"
- **BCA Virtual Account:** Auto-approve di sandbox

---

## 📊 Fitur-Fitur Customer

### User Management
- ✅ Sign Up dengan validasi email unik
- ✅ Login dengan rate limiting (anti brute force)
- ✅ Strong password policy (min 8 char, uppercase, lowercase, number)
- ✅ Profile management (update name, email, phone, avatar)

### Shopping Features
- ✅ Browse products dengan filter kategori
- ✅ Search products (real-time suggestions)
- ✅ Product detail dengan multiple images
- ✅ Add to Cart
- ✅ Add to Wishlist
- ✅ Checkout dengan Midtrans payment
- ✅ Transaction history
- ✅ Review products

### Security Features
- ✅ Rate limiting (5 attempts/60 seconds)
- ✅ CSRF protection
- ✅ XSS protection dengan input sanitization
- ✅ Security headers
- ✅ File upload validation (mime type & size)
- ✅ Logging & monitoring

---

## 💡 Troubleshooting (Masalah Umum)

| Masalah | Solusi |
| :--- | :--- |
| **Gambar tidak muncul** | Jalankan `php artisan storage:link` dan pastikan `APP_URL` di `.env` sudah benar. |
| **Payment webhook tidak jalan** | Pastikan ngrok berjalan dan URL di Midtrans Dashboard sudah benar. |
| **Gagal Login Admin (Forbidden)** | Pastikan Anda tidak sedang login sebagai customer di tab browser yang sama. Gunakan Mode Incognito. |
| **Upload Gambar Error** | Cek permission folder `storage/app/public`. Pastikan writable. |
| **Real-time Update tidak jalan** | Pastikan Anda menjalankan `composer run dev` (Reverb akan auto-start). |
| **Tampilan Berantakan** | Jalankan `npm run build` dan clear browser cache. |
| **Rate Limit Error** | Tunggu 60 detik atau clear cache: `php artisan cache:clear` |
| **Password Validation Error** | Password harus min 8 char dengan uppercase, lowercase, dan number. |

---

## 🔄 Update Database Schema

Jika ada perubahan struktur database:
```bash
php artisan migrate:fresh --seed
```
> **Warning:** Ini akan menghapus semua data!

---

## 📄 Ringkasan Perintah Cepat (Cheat Sheet)

```bash
# Setup awal
composer install
cp .env.example .env
php artisan key:generate

# Konfigurasi database di .env
# DB_DATABASE=exitem
# DB_USERNAME=root
# DB_PASSWORD=p455w0rd

# Konfigurasi Midtrans di .env
# MIDTRANS_SERVER_KEY=xxx
# MIDTRANS_CLIENT_KEY=xxx

# Setup database
php artisan migrate --seed

# Setup frontend
npm install
npm run build

# Link storage
php artisan storage:link

# Jalankan aplikasi
composer run dev

# Terminal terpisah untuk ngrok (optional)
ngrok http 8000
```

---

## 📚 Dokumentasi Tambahan

- **Laravel:** [https://laravel.com/docs](https://laravel.com/docs)
- **Livewire:** [https://livewire.laravel.com](https://livewire.laravel.com)
- **Filament:** [https://filamentphp.com](https://filamentphp.com)
- **Midtrans:** [https://docs.midtrans.com](https://docs.midtrans.com)
- **Tailwind CSS:** [https://tailwindcss.com/docs](https://tailwindcss.com/docs)

---

## 🤝 Kontribusi & Support

Jika Anda menemukan bug atau memiliki saran, silakan buat issue di repository ini.

**Happy Coding! 🚀**
