# 📄 Product Requirements Document (PRD)
**Project Name:** Exclusive E-Commerce
**Module:** Homepage (Landing Page)
**Platform:** Web (Responsive)
**Document Version:** 1.1

## 1. Ringkasan Modul (Module Overview)
Modul *Homepage* berfungsi sebagai titik masuk utama bagi pelanggan. Tujuannya adalah menyajikan navigasi yang jelas, mempromosikan penawaran terbaik (diskon/promo), dan mengarahkan pengguna ke corong penjualan (*sales funnel*) melalui etalase produk terlaris dan terbaru.

## 2. Fitur & Kebutuhan UI (User Interface Requirements)
Berdasarkan *mockup* HTML yang ada, *Homepage* dibagi menjadi beberapa seksi wajib:

### 2.1. Global Navigation (Header)
* **Logo:** Identitas sistem (Exclusive).
* **Tautan Statis:** Mengarahkan ke halaman *Home*, *Contact*, *About*, dan *Sign Up*.
* **Search Bar:** Kolom pencarian teks dengan fungsionalitas pencarian langsung.
* **Ikon Utilitas:** 
  * *Wishlist* (Favorit).
  * *Cart* (Keranjang belanja).
  * *Dropdown Profile* (Interaktif: My Account, Orders, Wishlist, Logout).

### 2.2. Hero Section
* **Sidebar Kategori:** Menampilkan daftar kategori utama secara vertikal (maksimal 6-8 kategori) untuk navigasi cepat.
* **Hero Banner:** Menampilkan promo kampanye utama (contoh: *iPhone 14 Series - Up to 10% Off*) dilengkapi dengan gambar dan tombol *Call-to-Action* (CTA) "Shop Now".

### 2.3. Category Highlight ("Browse By Category")
* Menampilkan *grid* ikon kategori interaktif. 
* Fungsionalitas: Saat diklik, akan memfilter produk yang tampil atau mengarahkan pengguna ke halaman pencarian spesifik kategori tersebut.

### 2.4. Product Showcases
* **Best Selling ("This Month"):** 
  * Menampilkan 4 produk dengan penjualan tertinggi. 
  * Elemen wajib pada kartu produk: Gambar, Tombol *Add to Cart* (dinamis muncul saat *hover*), Judul, Harga Diskon, Harga Asli (dicoret), dan *Rating* bintang beserta jumlah ulasan.
* **Explore Products:** 
  * Menampilkan 4-8 produk acak atau terbaru untuk eksplorasi umum pengguna.
  * Memiliki elemen kartu produk yang sama dengan bagian *Best Selling*.

### 2.5. New Arrival ("Featured")
* Menampilkan tata letak *grid* asimetris bergaya poster.
* Menyoroti 4 entitas (produk unggulan atau koleksi terbaru seperti PlayStation 5, Women's Collections, Speakers, Perfume).

### 2.6. Trust Indicators (Services)
* Tiga kolom statis untuk membangun kepercayaan pelanggan, berisi ikon dan teks:
  1. *Free and Fast Delivery*
  2. *24/7 Customer Service*
  3. *Money Back Guarantee*

### 2.7. Global Footer
* Informasi merek dan kontak perusahaan.
* Tautan pendukung (*Support*, *Account*).
* Formulir *newsletter subscription* (memasukkan email).
