# 📄 Product Requirements Document (PRD)
**Project Name:** ExItem E-Commerce
**Module:** Product Detail Page (PDP)
**Platform:** Web (Responsive)
**Document Version:** 1.0

## 1. Ringkasan Modul (Module Overview)
Halaman *Product Detail* berfungsi sebagai pusat konversi di mana pelanggan dapat melihat informasi spesifik suatu produk, memilih variasi (warna, ukuran), menentukan jumlah pembelian, dan melakukan aksi inti (*Buy Now* atau *Add to Wishlist*).

## 2. Fitur & Kebutuhan UI (User Interface Requirements)

### 2.1. Navigasi & Konteks
* **Global Header:** Memuat logo, navigasi utama, pencarian, dan ikon utilitas pengguna (keranjang, *wishlist*, profil).
* **Breadcrumb:** Menunjukkan letak hierarki produk saat ini (contoh: *Account / Gaming / Havic HV G-92 Gamepad*) untuk memudahkan pengguna kembali ke kategori sebelumnya.

### 2.2. Product Gallery (Media Interaktif)
* **Main Image:** Menampilkan gambar produk ukuran besar.
* **Thumbnails:** Menampilkan 4-5 gambar alternatif berukuran kecil.
* **Interaksi:** Jika *thumbnail* diklik, *Main Image* akan berubah secara instan sesuai dengan gambar *thumbnail* tersebut. *Thumbnail* yang aktif akan memiliki penanda visual (kelas `.active`).

### 2.3. Informasi Produk Utama
* **Judul & Harga:** Menampilkan nama produk secara jelas dan harga aktual.
* **Rating & Ulasan:** Menampilkan representasi visual bintang berdasarkan rata-rata *rating*, beserta total jumlah ulasan.
* **Status Stok:** Indikator ketersediaan barang (contoh: *In Stock*, *Out of Stock*).
* **Deskripsi Singkat:** Paragraf penjelasan fitur utama produk.

### 2.4. Pemilihan Variasi (Product Options)
* **Colours (Warna):** Pengguna wajib dapat memilih satu warna. Disajikan dalam bentuk *radio button* yang disamarkan menjadi elemen lingkaran berwarna.
* **Size (Ukuran):** Pengguna wajib dapat memilih satu ukuran (XS, S, M, L, XL). Opsi yang dipilih harus memiliki penanda status aktif.

### 2.5. Aksi Pembelian (Purchase Actions)
* **Quantity Selector:** * Tombol `+` untuk menambah jumlah.
  * Tombol `-` untuk mengurangi jumlah.
  * Input manual angka.
  * **Validasi:** Angka tidak boleh kurang dari 1.
* **Buy Now:** Tombol *Call-to-Action* utama untuk menginisiasi proses *checkout*.
* **Wishlist:** Tombol ikon hati untuk menyimpan produk ke daftar keinginan.

### 2.6. Informasi Tambahan & Relasi
* **Delivery Info:** Blok informasi statis mengenai jaminan pengiriman gratis dan kebijakan pengembalian barang.
* **Related Items:** Menampilkan *grid* produk lain yang berada di kategori yang sama atau direkomendasikan sistem.
