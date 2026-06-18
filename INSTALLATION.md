# 🚀 Panduan Instalasi Exitem — Lengkap & Mudah

Selamat datang di project **Exitem**! Dokumen ini dirancang untuk membantu Anda menjalankan project ini di komputer lokal dengan langkah-langkah yang jelas, detail, dan anti-gagal.

---

## 📋 Prasyarat Sistem

Sebelum memulai, pastikan komputer Anda sudah terinstal:

1.  **PHP 8.2 atau lebih baru** (Rekomendasi: 8.3)
2.  **Composer** (Package Manager PHP)
3.  **Node.js 18.x & npm** (Untuk aset frontend)
4.  **MySQL 8.0** (Database)

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
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=exitem
    DB_USERNAME=root
    DB_PASSWORD=      # Isi jika MySQL Anda memiliki password
    ```
4.  **PENTING (Untuk Upload Gambar):** Pastikan `APP_URL` di `.env` adalah:
    ```env
    APP_URL=http://127.0.0.1:8000
    ```

### 6. Migrasi & Seeding Database
Membuat struktur tabel dan mengisi data awal (termasuk akun admin):
```bash
php artisan migrate --seed
```

### 7. Install Dependency Frontend
Unduh library untuk tampilan (Tailwind, Vite, Echo):
```bash
npm install
```

### 8. Build Assets
Kompilasi file CSS dan JavaScript:
```bash
npm run build
```

### 9. Hubungkan Folder Storage
Agar gambar produk dan banner bisa tampil di browser:
```bash
php artisan storage:link
```

---

## ⚡ Cara Menjalankan Aplikasi

Project ini telah dikonfigurasi agar Anda bisa menjalankan semuanya (Server, Vite, WebSocket Reverb, dan Queue) hanya dengan **satu perintah saja**.

Cukup jalankan:
```bash
php artisan serve
```

*Sekarang, aplikasi Anda sudah berjalan sepenuhnya di:* `http://127.0.0.1:8000`

---

## 🔐 Akses Admin Panel

Panel Admin digunakan untuk mengelola produk, kategori, banner, dan transaksi.

*   **URL**: `http://127.0.0.1:8000/admin`
*   **Email**: `admin@admin.com`
*   **Password**: `Miawmiawmiaw`

> **Catatan:** Fitur registrasi di halaman admin telah dinonaktifkan demi keamanan. Gunakan akun di atas untuk masuk.

---

## 💡 Troubleshooting (Masalah Umum)

| Masalah | Solusi |
| :--- | :--- |
| **Gambar tidak muncul** | Jalankan `php artisan storage:link` dan pastikan `APP_URL` di `.env` sudah benar. |
| **Gagal Login (Forbidden)** | Pastikan Anda tidak sedang login sebagai user biasa di tab browser yang sama. Gunakan Mode Incognito. |
| **Upload Gambar Stuck** | Pastikan `APP_URL` di `.env` adalah `http://127.0.0.1:8000`. |
| **Real-time Update tidak jalan** | Pastikan Anda menjalankan `php artisan serve` (karena otomatis menjalankan server WebSocket Reverb). |
| **Tampilan Berantakan** | Jalankan `npm run build` atau biarkan `php artisan serve` berjalan. |

---

## 📄 Ringkasan Perintah Cepat (Cheat Sheet)

```bash
composer install
cp .env.example .env
php artisan key:generate
# [Sesuaikan DB di .env]
php artisan migrate --seed
npm install
npm run build
php artisan storage:link
php artisan serve
```
