# 📄 Product Requirements Document (PRD)
**Project Name:** ExItem E-Commerce
**Module:** About Us Page
**Platform:** Web (Responsive)
**Document Version:** 2.0 (Livewire Migration Prepared)

## 1. Tujuan Modul
Menyajikan profil perusahaan yang dinamis. Dalam skala E-Commerce produksi, data seperti statistik perusahaan dan anggota tim tidak boleh di-*hardcode* di HTML, melainkan harus dapat dikelola (*manageable*).

## 2. User Stories & Acceptance Criteria

### 2.1. Tinjauan Perusahaan (Company Overview)
* **User Story:** Sebagai pengunjung, saya ingin melihat statistik pencapaian Exitem agar saya yakin dengan kredibilitas platform.
* **Acceptance Criteria:** * Teks dan angka (15K+, 500+, 99%) dirender secara sempurna.
  * *Edge Case:* Jika data belum dimuat, tampilkan *skeleton loader* atau nilai bawaan.

### 2.2. Representasi Tim (Team Showcase)
* **User Story:** Sebagai pengunjung, saya ingin melihat siapa saja sosok di balik Exitem.
* **Acceptance Criteria:**
  * Menampilkan minimal 5 anggota tim menggunakan fitur *slider* (Swiper).
  * *Slider* harus bergeser otomatis setiap 3 detik.
  * Terdapat navigasi panah (kiri/kanan) dan titik paginasi yang berfungsi.
  * Responsivitas layar ditaati: 1 kartu (HP), 2 kartu (Tablet), 3 kartu (Desktop).

## 3. Kebutuhan Migrasi Berbasis Komponen (Component-Driven)
Halaman ini harus dipecah menjadi beberapa *Presentational Components* agar dapat digunakan ulang di halaman lain (misalnya komponen `CardTeam` atau `StatCounter`).
