# 🎨 Design System & UI Architecture
**Module:** Checkout & Billing

## 1. Design Tokens
* **Background Utama:** `#f3f5f7`
* **Warna Form Input:** `#eee` (Memberikan kontras visual yang membedakan area input dengan latar belakang putih formulir).
* **Warna Eror (Alert Text):** `rgb(135,0,0)` (Merah gelap pekat, menyampaikan urgensi kesalahan tanpa menyilaukan mata).
* **Primary Button (Checkout):** `#92deff` (Biru langit pastel dengan teks dan garis tepi hitam, memberikan kesan modern/brutalisme ringan).

## 2. Layout & Spacing
* **Struktur Halaman:** Menggunakan tata letak Flexbox 2 kolom (`display: flex; gap: 1cm;`) dengan lebar maksimal kontainer `80%`.
* **Area Kiri (Formulir):** Memiliki batas lebar maksimal `500px` agar input teks tidak melebar terlalu panjang yang dapat merusak estetika dan keterbacaan.
* **Area Kanan (Ringkasan):** Kotak statis dengan lebar tetap `260px`, memberikan batas pandangan yang jelas untuk rincian biaya.
* **Tipografi Form:** Menggunakan `font-size: 13px` untuk konsistensi di seluruh label, input, dan ringkasan teks.
