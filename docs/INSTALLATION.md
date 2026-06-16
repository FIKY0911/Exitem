# Panduan Instalasi Exitem — Lengkap untuk Pemula

> Dokumen ini ditujukan untuk siapa saja yang ingin menjalankan project Exitem di komputer lokal mereka, termasuk yang belum familiar dengan Laravel.

---

## Daftar Isi

1. [Apa yang Perlu Diinstal](#1-apa-yang-perlu-diinstal)
2. [Clone / Download Project](#2-clone--download-project)
3. [Install Composer Dependencies](#3-install-composer-dependencies)
4. [Buat File `.env`](#4-buat-file-env)
5. [Generate Application Key](#5-generate-application-key)
6. [Konfigurasi Database](#6-konfigurasi-database)
7. [Jalankan Migrasi Database](#7-jalankan-migrasi-database)
8. [Isi Data Awal (Seeder)](#8-isi-data-awal-seeder)
9. [Install Node Dependencies](#9-install-node-dependencies)
10. [Build Assets CSS & JS](#10-build-assets-css--js)
11. [Buat Symlink Storage](#11-buat-symlink-storage)
12. [Jalankan Aplikasi](#12-jalankan-aplikasi)
13. [Akses Aplikasi](#13-akses-aplikasi)
14. [Troubleshooting](#14-troubleshooting)

---

## 1. Apa yang Perlu Diinstal

Sebelum memulai, pastikan semua software berikut sudah terinstal di komputermu.

### PHP 8.2 atau lebih baru

Laravel 12 membutuhkan PHP versi 8.2+.

**Cek versi PHP yang terinstal:**
```bash
php -v
```

Output yang diharapkan (versi harus 8.2 ke atas):
```
PHP 8.2.x (cli)
```

**Cara install PHP di Linux (Ubuntu/Debian):**
```bash
sudo apt update
sudo apt install php8.2 php8.2-cli php8.2-mbstring php8.2-xml php8.2-mysql php8.2-zip php8.2-bcmath php8.2-curl php8.2-tokenizer php8.2-fileinfo
```

**Cara install PHP di Windows:**
- Download dari [https://windows.php.net/download](https://windows.php.net/download)
- Pilih versi **Non Thread Safe x64**
- Ekstrak dan tambahkan ke PATH

---

### Composer

Composer adalah package manager untuk PHP — fungsinya seperti `npm` untuk Node.js.

**Cek apakah Composer sudah terinstal:**
```bash
composer -V
```

**Cara install Composer di Linux:**
```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

**Cara install Composer di Windows:**
- Download installer dari [https://getcomposer.org/download/](https://getcomposer.org/download/)
- Jalankan file `.exe` dan ikuti petunjuknya

---

### Node.js dan npm

Digunakan untuk mengkompilasi CSS (Tailwind) dan JavaScript (Vite).

**Cek apakah Node.js sudah terinstal:**
```bash
node -v
npm -v
```

Versi yang dibutuhkan: Node.js **18.x** ke atas.

**Cara install Node.js di Linux:**
```bash
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs
```

**Cara install Node.js di Windows:**
- Download dari [https://nodejs.org](https://nodejs.org) (pilih versi LTS)

---

### MySQL 8.0

Database yang digunakan aplikasi ini adalah MySQL.

**Cara install MySQL di Linux:**
```bash
sudo apt install mysql-server
sudo mysql_secure_installation
```

**Cara install di Windows:**
- Download MySQL Installer dari [https://dev.mysql.com/downloads/installer/](https://dev.mysql.com/downloads/installer/)
- Atau gunakan **XAMPP** yang sudah include MySQL: [https://www.apachefriends.org](https://www.apachefriends.org)

---

## 2. Clone / Download Project

### Jika menggunakan Git:
```bash
git clone <url-repository> exitem
cd exitem
```

### Jika download ZIP:
1. Download file ZIP dari repository
2. Ekstrak ke folder, misalnya `C:\xampp\htdocs\exitem` (Windows) atau `~/projects/exitem` (Linux)
3. Buka terminal, masuk ke folder tersebut:
```bash
cd /path/ke/folder/exitem
```

---

## 3. Install Composer Dependencies

Perintah ini mengunduh semua library PHP yang dibutuhkan project (disimpan di folder `vendor/`).

```bash
composer install
```

> **Ini mungkin butuh beberapa menit** tergantung koneksi internet. Tunggu sampai selesai.

Setelah selesai, akan muncul pesan seperti:
```
Generating optimized autoload files
```

**Apa yang diinstall oleh Composer?**

Package utama yang diinstall:

| Package | Versi | Fungsi |
|---------|-------|--------|
| `laravel/framework` | ^12.0 | Core framework Laravel |
| `filament/filament` | ^5.0 | Panel admin (dashboard) |
| `livewire/livewire` | (via filament) | Komponen UI dinamis tanpa JavaScript manual |
| `laravel/tinker` | ^2.10.1 | REPL untuk berinteraksi dengan aplikasi via terminal |
| `blade-ui-kit/blade-heroicons` | ^2.3 | Icon set untuk tampilan UI |

Package development (hanya untuk local/testing):

| Package | Versi | Fungsi |
|---------|-------|--------|
| `laravel/pint` | ^1.24 | Code formatter PHP |
| `laravel/sail` | ^1.41 | Docker environment untuk Laravel |
| `pestphp/pest` | ^3.8 | Framework testing |
| `fakerphp/faker` | ^1.23 | Generate data dummy untuk testing |
| `nunomaduro/collision` | ^8.6 | Error reporting yang lebih cantik |

---

## 4. Buat File `.env`

File `.env` adalah file konfigurasi utama aplikasi — berisi setting database, URL, key, dll. File ini **tidak ikut di-commit ke Git** karena berisi data sensitif.

Salin file contoh `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

**Di Windows (Command Prompt):**
```cmd
copy .env.example .env
```

> Setelah ini kamu akan punya file `.env` di root folder project. Buka file ini dengan text editor untuk konfigurasi selanjutnya.

---

## 5. Generate Application Key

Laravel menggunakan `APP_KEY` untuk mengenkripsi sesi, cookie, dan data sensitif lainnya. Tanpa key ini, aplikasi **tidak akan bisa berjalan**.

```bash
php artisan key:generate
```

Output:
```
INFO  Application key set successfully.
```

Perintah ini otomatis mengisi nilai `APP_KEY=base64:...` di file `.env`.

> **Jangan pernah share `APP_KEY` ke publik** — ini adalah kunci enkripsi aplikasimu.

---

## 6. Konfigurasi Database

### Buat Database di MySQL

Masuk ke MySQL terlebih dahulu:

```bash
mysql -u root -p
```

Kemudian buat database baru:

```sql
CREATE DATABASE exitem CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

Jika menggunakan **phpMyAdmin** (XAMPP):
1. Buka `http://localhost/phpmyadmin`
2. Klik **"New"** di sidebar kiri
3. Isi nama database: `exitem`
4. Pilih collation: `utf8mb4_unicode_ci`
5. Klik **"Create"**

---

### Edit File `.env`

Buka file `.env` dan ubah bagian database sesuai dengan settingmu:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=exitem
DB_USERNAME=root
DB_PASSWORD=
```

> - `DB_DATABASE` → nama database yang baru kamu buat (`exitem`)
> - `DB_USERNAME` → username MySQL kamu (biasanya `root`)
> - `DB_PASSWORD` → password MySQL kamu (kosongkan jika tidak ada password)

---

## 7. Jalankan Migrasi Database

Migrasi adalah cara Laravel membuat tabel-tabel di database secara otomatis dari kode PHP.

```bash
php artisan migrate
```

Output yang diharapkan:
```
INFO  Running migrations.
  2024_01_01_000000_create_users_table .............. DONE
  2024_01_01_000001_create_cache_table .............. DONE
  ... (dan seterusnya)
```

**Tabel yang akan dibuat:**

| Tabel | Keterangan |
|-------|------------|
| `users` | Data pengguna (nama, email, password, role, avatar, phone) |
| `categories` | Kategori produk |
| `brands` | Merek/brand produk |
| `products` | Data produk (nama, harga, stok, warna, ukuran) |
| `product_images` | Gambar-gambar produk |
| `transactions` | Data order/transaksi pembelian |
| `wishlists` | Produk yang di-wishlist user |
| `banners` | Banner/slider di halaman utama |
| `contact_messages` | Pesan dari halaman Contact Us |
| `settings` | Pengaturan halaman About dan info toko |
| `team_members` | Data anggota tim (untuk halaman About) |
| `sessions` | Data sesi login user |
| `cache` | Cache aplikasi |
| `jobs` | Antrian background jobs |

---

## 8. Isi Data Awal (Seeder)

Seeder mengisi database dengan data awal yang dibutuhkan, seperti akun admin.

```bash
php artisan db:seed --class=AdminUserSeeder
```

Perintah ini membuat akun admin dengan kredensial:

| Field | Value |
|-------|-------|
| Email | `admin@admin.com` |
| Password | `admin` |
| Role | `admin` |

> **Penting:** Ganti password admin setelah berhasil login pertama kali!

Untuk mengisi data pengaturan halaman About:
```bash
php artisan db:seed --class=AboutSettingsSeeder
```

Atau jalankan semua seeder sekaligus:
```bash
php artisan db:seed
```

---

## 9. Install Node Dependencies

Perintah ini mengunduh semua package JavaScript yang dibutuhkan (disimpan di folder `node_modules/`).

```bash
npm install
```

**Package yang diinstall:**

| Package | Fungsi |
|---------|--------|
| `vite` | Build tool untuk compile asset |
| `tailwindcss` | Framework CSS utility-first |
| `@tailwindcss/vite` | Plugin Tailwind untuk Vite |
| `laravel-vite-plugin` | Integrasi Vite dengan Laravel |
| `axios` | HTTP client untuk request AJAX |
| `concurrently` | Jalankan beberapa perintah sekaligus |

---

## 10. Build Assets CSS & JS

Compile file Tailwind CSS dan JavaScript menjadi file yang siap dipakai browser.

**Untuk development** (ada hot-reload, otomatis update saat kode berubah):
```bash
npm run dev
```

**Untuk production** (file di-minify, ukuran lebih kecil):
```bash
npm run build
```

> Untuk pertama kali setup, jalankan `npm run build` dulu. Nanti saat development aktif, jalankan `npm run dev` di terminal terpisah.

---

## 11. Buat Symlink Storage

Laravel menyimpan file upload (gambar produk, avatar, dll) di folder `storage/`. Agar file-file ini bisa diakses lewat browser, perlu dibuat symbolic link ke folder `public/`.

```bash
php artisan storage:link
```

Output:
```
INFO  The [public/storage] link has been connected to [storage/app/public].
```

> Tanpa langkah ini, gambar produk dan avatar tidak akan tampil.

---

## 12. Jalankan Aplikasi

### Cara Mudah (semua dalam satu perintah):

```bash
composer run dev
```

Perintah ini menjalankan 3 hal sekaligus:
- **Web server** Laravel di `http://localhost:8000`
- **Queue worker** untuk memproses background jobs
- **Vite dev server** untuk hot-reload CSS/JS

### Atau jalankan manual (buka 2 terminal terpisah):

**Terminal 1 — Web Server:**
```bash
php artisan serve
```

**Terminal 2 — Vite (CSS/JS):**
```bash
npm run dev
```

---

## 13. Akses Aplikasi

Buka browser dan akses URL berikut:

| URL | Halaman |
|-----|---------|
| `http://localhost:8000` | Halaman utama toko Exitem |
| `http://localhost:8000/admin` | Panel Admin (Filament) |
| `http://localhost:8000/login` | Halaman login user |
| `http://localhost:8000/register` | Halaman daftar akun baru |

**Login Admin:**
- Email: `admin@admin.com`
- Password: `admin`

---

## 14. Troubleshooting

### ❌ Error: "No application encryption key has been specified"
**Solusi:** Jalankan `php artisan key:generate`

---

### ❌ Error: "SQLSTATE: Connection refused" atau tidak bisa konek database
**Solusi:**
1. Pastikan MySQL sudah berjalan
2. Cek ulang `DB_USERNAME` dan `DB_PASSWORD` di `.env`
3. Pastikan database `exitem` sudah dibuat

---

### ❌ Gambar produk tidak muncul
**Solusi:** Jalankan `php artisan storage:link`

---

### ❌ Halaman tampil tapi tanpa CSS (tampilan berantakan)
**Solusi:** Jalankan `npm run build` atau pastikan `npm run dev` sedang berjalan

---

### ❌ Error saat `composer install`: "Your PHP version does not satisfy..."
**Solusi:** Update PHP ke versi 8.2+. Cek dengan `php -v`

---

### ❌ Halaman admin `/admin` tidak bisa diakses (403 Forbidden)
**Solusi:** Pastikan user yang login memiliki role `admin`. Jalankan:
```bash
php artisan db:seed --class=AdminUserSeeder
```
Kemudian login dengan `admin@admin.com` / `admin`

---

### ❌ Error: "Class not found" atau autoload error
**Solusi:** Jalankan ulang:
```bash
composer dump-autoload
```

---

### ❌ Error permission pada Linux
**Solusi:**
```bash
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R $USER:www-data storage bootstrap/cache
```

---

## Ringkasan Semua Perintah (Cheat Sheet)

```bash
# 1. Masuk ke folder project
cd /path/ke/exitem

# 2. Install PHP dependencies
composer install

# 3. Buat file .env
cp .env.example .env

# 4. Generate key enkripsi
php artisan key:generate

# 5. [Edit .env] → isi DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 6. Buat database di MySQL, lalu jalankan migrasi
php artisan migrate

# 7. Isi data awal (akun admin)
php artisan db:seed --class=AdminUserSeeder

# 8. Install Node dependencies
npm install

# 9. Build CSS & JS
npm run build

# 10. Buat symlink storage
php artisan storage:link

# 11. Jalankan server
composer run dev
# atau
php artisan serve
```
