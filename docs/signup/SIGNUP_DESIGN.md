# Design Document: Signup Module

Dokumen ini merinci identitas visual dan elemen desain untuk halaman pendaftaran (**Signup**) ExItem.

---

## 1. Konsep Visual
- **Tema:** Dark Mode Modern / Minimalis.
- **Background:** Gelap (`#111`) dengan overlay hero yang memberikan kontras pada teks putih.

## 2. Palet Warna
- **Latar Belakang:** `#111111`
- **Aksen Utama (CTA):** `#8B1A1A` (Merah Marun)
- **Aksen Hover:** `#a52323`
- **Teks Utama:** `#FFFFFF` (Putih)
- **Teks Sekunder:** `rgba(255,255,255,0.7)`

## 3. Tipografi
- **Font Family:** `Poppins`, Sans-serif.
- **Header:** Font size 34px, letter-spacing 1px.
- **Input:** Font size 15px, minimalis tanpa border samping/atas (hanya border-bottom).

## 4. Elemen Antarmuka (UI Elements)
- **Form Container:**
    - Background: `rgba(0, 0, 0, 0.45)`
    - Border-radius: `20px`
    - Shadow: `0 10px 28px rgba(0,0,0,0.25)`
    - Blur: `backdrop-filter: blur(4px)`
- **Button:**
    - Padding: 15px
    - Radius: 4px
    - Transition: 0.3s ease

## 5. Responsivitas
- **Desktop:** Layout terpusat di tengah layar.
- **Mobile:** Lebar container menyesuaikan layar (padding responsif), navigasi navbar bertumpuk secara vertikal.
