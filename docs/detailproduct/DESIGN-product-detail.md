# 🎨 Design System: Product Detail Page (PDP)
**Project Name:** ExItem E-Commerce
**Platform:** Web Application
**Document Version:** 1.0

## 1. Design Tokens (Variabel Dasar)
Token desain ini adalah nilai absolut yang tidak boleh dimodifikasi sembarangan untuk menjaga konsistensi identitas visual eksklusif E-Commerce.

### 1.1. Color Palette
* **Primary Red:** `#DB4444` 
  *(Digunakan untuk CTA utama seperti tombol Buy Now, badge diskon, status aktif pada opsi ukuran, dan aksen visual).*
* **Text Black:** `#000000` 
  *(Warna teks hierarki pertama, judul produk, teks roti lapis/breadcrumb aktif, dan border elemen yang difokuskan).*
* **Text Gray (Muted):** `#7D8184` 
  *(Warna teks sekunder untuk breadcrumb pasif, harga coret/old-price, dan teks ulasan).*
* **Background Light:** `#F5F5F5` 
  *(Warna latar belakang netral untuk area gambar produk, baik thumbnail maupun gambar utama).*
* **Success Green:** `#00FF66` 
  *(Khusus untuk indikator ketersediaan stok).*
* **Star Yellow:** `#FFAD33` 
  *(Khusus untuk ikon rating bintang yang terisi).*
* **Border/Divider:** `rgba(0,0,0,0.3)` hingga `rgba(0,0,0,0.5)` 
  *(Digunakan untuk garis pembatas antar seksi, border kartu pengiriman, dan kotak kuantitas).*

### 1.2. Typography
Halaman ini menggunakan komposisi *single-font* untuk memperkuat kesan modern dan minimalis.
* **Global Font Family:** `'Inter', sans-serif`
* **Heading 1 (Nama Produk & Harga Utama):** `24px`, Semi-Bold (`600`).
* **Heading 3 (Nama Produk Terkait):** `16px`, Medium.
* **Body Text (Deskripsi & Label):** `14px`, dengan *line-height* `1.5` agar mudah dibaca.
* **Microcopy (Badge & Info Ekstra):** `12px`.

## 2. Layout & Spacing System
* **Global Container:** Lebar maksimal `1170px` dengan *padding* horizontal `20px` dan vertikal `40px`.
* **Product Main Grid:** Menggunakan Flexbox dengan proporsi asimetris, jarak (`gap`) antara area Galeri dan area Info adalah `70px`.
* **Related Products:** Grid 4 kolom (`repeat(4, 1fr)`) dengan *gap* `30px`.

## 3. Component Library (Atomic Design)

### 3.1. Atoms (Elemen Fundamental)
* **Size Button:** Kotak berukuran `32px x 32px`, *border-radius* `4px`. Jika aktif, latar berubah menjadi *Primary Red* dan teks menjadi putih.
* **Color Radio:** Lingkaran berukuran `20px` tanpa garis tepi. Jika dipilih (*checked*), akan muncul garis tepi hitam tebal dengan *inset shadow* putih (`box-shadow: 0 0 0 1px white inset`).
* **Section Pill:** Blok warna merah berukuran `20px x 40px` dengan sudut membulat `4px`.
* **Action Icon (Wishlist/Eye):** Lingkaran putih berisi ikon, berukuran proporsional untuk diklik.

### 3.2. Molecules (Gabungan Atom)
* **Quantity Selector:** Sebuah kotak bergaris tepi membulat yang membungkus tiga atom:
  * Tombol Minus (`40px x 44px`, putih)
  * Input Angka (`80px` lebar, tebal teks `600`, tanpa panah *spinner* bawaan browser)
  * Tombol Plus (Latar *Primary Red*, teks putih)
* **Delivery Item:** Kombinasi ikon berukuran besar (`40px`) di sebelah kiri, dengan tumpukan judul tebal (`16px`) dan deskripsi kecil bergaris bawah (`12px`) di sebelah kanan. Jarak antar elemen `16px`.
* **Rating & Stock:** Kombinasi ikon bintang kuning/abu-abu, angka ulasan, dan teks status stok berwarna hijau yang disusun sejajar (horizontal).

### 3.3. Organisms (Blok Fungsional Kompleks)
* **Product Gallery:** * Terdiri dari 1 *Main Image* (`500px x 600px`) dan tumpukan vertikal *Thumbnails* (masing-masing `170px x 138px`). Semua menggunakan latar `#F5F5F5`.
* **Product Options Board:**
  * Kumpulan baris (*rows*) yang menampung variasi warna, variasi ukuran, dan blok kontrol kuantitas serta tombol CTA (*Buy Now* & *Wishlist*).
* **Delivery Card:** * Kotak dengan garis tepi tipis yang menampung kumpulan *Delivery Item*. Antar *item* dipisahkan oleh garis tepi bawah internal (`border-bottom`).
* **Related Product Card:**
  * *Image Container* (tinggi `250px`, latar `#F5F5F5`) yang memuat badge diskon secara absolut di kiri atas dan *Action Icons* di kanan atas.
  * *Info Container* yang memuat nama produk, harga (baru dan lama), serta komponen molekul *rating*.

## 4. Implementasi Khusus (Dev Notes)
* Area kuantitas menggunakan properti CSS khusus (`::-webkit-inner-spin-button { -webkit-appearance: none; }`) untuk menyembunyikan kontrol panah *default* dari *browser* pada tipe input angka, karena kita telah menyediakan tombol atom *custom* (+ dan -).
* Pergantian varian warna memanfaatkan trik CSS `input:checked + label` untuk memanipulasi DOM secara visual tanpa JavaScript. Pada implementasi Livewire/Alpine nanti, ini dapat diganti dengan fitur *data binding*.
