# 📄 Product Requirements Document (PRD)
**Project Name:** ExItem E-Commerce
**Module:** Checkout & Billing
**Platform:** Web (Responsive)
**Document Version:** 1.0

## 1. Ringkasan Modul
Halaman *Checkout* adalah tahap akhir dari corong penjualan (*sales funnel*). Pengguna diminta untuk mengisi informasi pengiriman/penagihan, meninjau kembali ringkasan pesanan, memilih metode pembayaran, dan menyelesaikan transaksi.

## 2. Fitur & Kebutuhan UI
* **Formulir Detail Penagihan (Billing Details):**
  * Meminta input vital: Nama Depan, Alamat Jalan, Kota, dan Nomor Telepon.
  * Opsi *checkbox* untuk menyimpan informasi pengguna untuk transaksi berikutnya.
* **Ringkasan Pesanan Statis:**
  * Menampilkan daftar produk yang dibeli dan total harga akhir yang harus dibayar.
* **Metode Pembayaran (Payment Gateway Mockup):**
  * Pengguna harus memilih satu dari tiga metode: Bank Transfer, Cash on Delivery (COD), atau QRIS.
  * **Fitur Dinamis:** Jika pengguna memilih "Bank Transfer", sistem akan memunculkan informasi nomor rekening dari berbagai bank. Informasi ini disembunyikan jika metode lain dipilih.
* **Validasi Sisi Klien (Client-Side Validation):**
  * Tombol *Checkout* tidak akan memproses pesanan jika:
    1. Ada kolom wajib yang masih kosong.
    2. Nomor telepon mengandung karakter selain angka (huruf/simbol).
    3. Belum ada metode pembayaran yang dipilih.
  * Menampilkan pesan eror spesifik di bawah setiap kolom yang bermasalah.
