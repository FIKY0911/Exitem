# 📄 Product Requirements Document (PRD)
**Project Name:** ExItem E-Commerce
**Module:** Shopping Cart
**Platform:** Web (Responsive)
**Document Version:** 1.0

## 1. Ringkasan Modul
Halaman *Cart* berfungsi sebagai tempat penampungan sementara sebelum pengguna melakukan pembayaran. Modul ini memungkinkan pengguna meninjau ulang barang yang ingin dibeli, mengubah jumlah pesanan, dan melihat estimasi total harga secara transparan.

## 2. Fitur & Kebutuhan UI (User Interface Requirements)
* **Daftar Produk (Data Table):**
  * Menampilkan informasi produk dalam format tabel (Gambar, Nama Produk, Harga Satuan, Kuantitas, dan Subtotal per produk).
* **Manajemen Kuantitas:**
  * Pengguna dapat mengetikkan atau menggunakan kontrol panah atas/bawah pada *input field* untuk mengubah jumlah barang.
  * Mencegah input angka negatif (validasi minimal `0`).
* **Kalkulasi Dinamis:**
  * Subtotal setiap baris produk harus diperbarui secara otomatis saat kuantitas diubah.
* **Update Cart Action:**
  * Tombol untuk mengeksekusi perhitungan ulang Total Harga seluruh keranjang.
  * Jika ada produk dengan kuantitas `0`, sistem akan memberikan peringatan dan menghapus produk tersebut dari keranjang secara otomatis.
* **Ringkasan Keranjang (Cart Total Box):**
  * Menampilkan Subtotal keseluruhan, biaya pengiriman (statis: Free), dan Total Akhir.
  * Tombol *Checkout* untuk melanjutkan ke halaman pembayaran.
