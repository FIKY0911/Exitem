# 🎨 Design System & UI Specification (DESIGN.md)
**Project Name:** Exclusive E-Commerce
**Platform:** Web Application
**Document Version:** 1.0

## 1. Design Tokens (Variabel Utama)
Sistem ini menggunakan CSS Variables (`:root`) untuk memastikan konsistensi warna di seluruh aplikasi. Ini adalah fondasi (Atom terkecil) dari desain kita.

### 1.1. Color Palette
* **Primary Red:** `#DB4444` *(Digunakan untuk CTA, harga diskon, highlight kategori, dan aksen visual)*
* **Text Black:** `#000000` *(Warna teks utama dan background elemen kontras seperti Footer & Hero)*
* **Text White:** `#FFFFFF` *(Warna teks di atas background gelap)*
* **Background Gray:** `#F5F5F5` *(Digunakan untuk background input pencarian, background thumbnail produk, dan status hover)*
* **Text Gray (Muted):** `#7D8184` *(Digunakan untuk teks sekunder, deskripsi layanan, dan harga coret)*
* **Star Yellow:** `#FFAD33` *(Khusus untuk ikon rating bintang)*

### 1.2. Typography
Sistem ini mengkombinasikan dua jenis *font* dari Google Fonts untuk membedakan hierarki informasi.
* **Primary Font (Body Text):** `'Poppins', sans-serif`
  * Digunakan untuk teks reguler, deskripsi, nama produk, dan elemen UI umum.
* **Secondary Font (Headings):** `'Inter', sans-serif`
  * Digunakan secara spesifik untuk penekanan struktural (Logo, Judul Seksi Utama / `.section-title`, dan Judul Hero Banner).
  * *Font Weight:* 400 (Regular), 500 (Medium), 600 (Semi-Bold), 700 (Bold).

## 2. Layout & Spacing System
Untuk menjaga keteraturan visual dan *whitespace*, kita menggunakan standar metrik berikut:

### 2.1. Container & Grid
* **Max Width:** `1170px` (Membatasi lebar maksimal konten agar tetap proporsional di layar besar).
* **Section Spacing:** Jarak antar seksi utama (atas dan bawah) adalah `80px`.
* **Grid Systems:**
  * *Categories:* 6 Kolom (`1fr` per kolom) dengan jarak `20px`.
  * *Products:* 4 Kolom dengan jarak `30px`.
  * *New Arrival:* Grid asimetris 2x2.
  * *Services:* 3 Kolom.
  * *Footer:* 4 Kolom.

### 2.2. Border Radius
* Standar sudut membulat (*border-radius*) untuk elemen interaktif (tombol, input, kartu) adalah `4px`.
* Pengecualian pada gambar *Hero Banner* menggunakan `20px`.

## 3. Component Library (Atomic Design)

### 3.1. Atoms (Elemen Dasar)
* **Buttons (`.btn-red`):** Background `#DB4444`, teks putih, tanpa garis tepi, *padding* `12px 24px`, *border-radius* `4px`.
* **Inputs:** Background `#F5F5F5` (atau transparan di Footer), tanpa garis tepi, *outline* dihilangkan.
* **Section Tag (`.red-rect`):** Aksen kotak merah berukuran `20px` x `40px` sebagai penanda awal seksi.

### 3.2. Molecules (Gabungan Elemen)
* **Search Box:** Menggabungkan *input field* transparan dan ikon pencarian di dalam *container* berlatar abu-abu.
* **Category Box (`.cat-box`):** Kotak berukuran tinggi `145px` dengan *border* tipis `0.5px`. Berisi ikon besar (`32px`) dan teks. Jika dalam mode aktif atau *hover*, warna berubah menjadi *Primary Red*.
* **Service Item:** Ikon besar di dalam lingkaran hitam (`50% border-radius`), di atas teks judul tebal dan deskripsi abu-abu.

### 3.3. Organisms (Komponen Kompleks)
* **Product Card:** 
  * *Thumbnail Area:* Latar abu-abu, tinggi `250px`.
  * *Hover Action:* Tombol "Add to Cart" hitam (`100% width`) muncul dari bawah (animasi `bottom: -50px` ke `0`) saat *card* di-*hover*.
  * *Info Area:* Nama produk (`font-weight: 500`), Harga utama (Merah), Harga lama (Abu-abu, coret), dan Ikon Rating.
* **New Arrival Poster (`.new-arrival-card`):** Menggunakan *background image* gelap, dengan teks putih rata bawah (*flex-end*). Kartu utama memiliki grid span 2 baris (`min-height: 580px`).

## 4. Interactions & States
* **Hover:** Menggunakan transisi `0.3s` untuk kelancaran animasi.
* **Active Links:** Ditandai dengan garis bawah tebal (Tautan navigasi) atau pergantian latar belakang (Kotak Kategori).
* **Dropdowns:** Menu profil diatur menggunakan `position: absolute` dan ditoggle dengan *class* `.show` via JavaScript (*Client-side interaction*).
