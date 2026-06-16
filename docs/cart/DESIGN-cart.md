# 🎨 Design System & UI Architecture
**Module:** Shopping Cart

## 1. Design Tokens
* **Background Utama:** `#f3f5f7` (Memberikan kesan bersih yang membedakan keranjang dengan kontainer putih).
* **Warna Teks:** `#333333` (Abu-abu sangat gelap untuk keterbacaan yang nyaman).
* **Primary Button (Checkout):** `#7497ad` (Biru baja/slate, warna aksi utama).
* **Typography:** `Arial, sans-serif`.

## 2. Struktur Komponen
* **Tabel Keranjang:** Menggunakan `border-spacing: 0 12px` untuk memberikan jarak (*gap*) antar baris (row) tanpa menggunakan *margin*, sehingga setiap produk terlihat seperti "kartu" terpisah (`.cart-item`) dengan efek `box-shadow` ringan.
* **Top Actions Layout:** Menggunakan *Flexbox* `justify-content: space-between` untuk memisahkan grup tombol navigasi (kiri) dan kotak ringkasan harga (kanan).
* **Cart Total Box:** Memiliki lebar tetap (`280px`) dengan *border* tegas (`1.5px solid black`) untuk menarik perhatian pengguna ke area konversi (*Checkout*).
