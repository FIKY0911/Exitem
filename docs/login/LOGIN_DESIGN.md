# Design Document: Login Module

Dokumen ini merinci identitas visual dan elemen desain untuk halaman masuk (**Login**) ExItem.

---

## 1. Konsep Visual
- **Tema:** Konsisten dengan Dark Mode ExItem.
- **Fokus Utama:** Kemudahan akses cepat (Quick Login) dengan antarmuka yang bersih.

## 2. Palet Warna
- **Primary Color:** `#000000` (Navbar & Footer)
- **Secondary Color:** `#111111` (Body Background)
- **Action Color:** `#8B1A1A` (Login Button)
- **Highlight:** `#fed136` (Digunakan pada hover link jika ada).

## 3. Tipografi & Layout
- **Header:** "Log In" (Size: 34px).
- **Form Layout:** Terdiri dari input stack yang rapi dengan jarak `margin-bottom: 25px` antar elemen input.
- **Action Row:** Menggunakan Flexbox untuk mengatur posisi tombol login dan tautan pendaftaran/lupa password dalam satu baris yang rapi.

## 4. Detail UI (UI Details)
- **Input Styling:**
    - Background: `transparent`
    - Border-bottom: `1px solid rgba(255,255,255,0.7)`
    - Padding: 10px
- **Visual Feedback:** Tombol berubah warna menjadi sedikit lebih terang (`#a52323`) saat kursor berada di atasnya (hover state).

## 5. Komponen Penunjang
- **Top Banner:** Memberikan informasi kontekstual promosi global.
- **Footer:** Menyediakan akses ke email dukungan dan nomor telepon untuk bantuan login.
