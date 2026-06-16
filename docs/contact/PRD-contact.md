# 📄 Product Requirements Document (PRD)
**Project Name:** ExItem E-Commerce
**Module:** Contact Us Page
**Platform:** Web (Responsive)
**Document Version:** 2.0 (Livewire Migration Prepared)

## 1. Tujuan Modul
Menyediakan antarmuka komunikasi *real-time* tanpa memuat ulang halaman (*Single Page Application experience*) menggunakan fungsionalitas Livewire, disertai validasi ketat untuk mencegah *spam*.

## 2. User Stories & Acceptance Criteria

### 2.1. Pengiriman Pesan
* **User Story:** Sebagai pelanggan, saya ingin mengirim pesan keluhan/saran agar mendapat bantuan dari tim Exitem.
* **Acceptance Criteria:**
  * Pengguna tidak dapat mengirim form jika ada *field* yang kosong.
  * Terdapat validasi format email.
  * Saat tombol kirim ditekan, muncul indikator *loading* (UX Improvement).
  * Pesan berhasil disimpan ke sistem, formulir kembali kosong (*reset*), dan muncul notifikasi sukses yang hilang otomatis setelah beberapa detik.

### 2.2. Keamanan & Performa
* **User Story:** Sebagai sistem, saya ingin membatasi pengiriman pesan beruntun agar *database* tidak terkena *spamming*.
* **Acceptance Criteria (Sisi Server):** Terdapat implementasi *Rate Limiting* (maksimal 3 pesan per menit dari IP yang sama).
