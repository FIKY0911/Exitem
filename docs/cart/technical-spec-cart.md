# 🛠️ Technical Specification (Tech Spec)
**Module:** Shopping Cart
**Stack:** HTML, CSS, JavaScript (Vanilla ES6+)
**Document Version:** 1.0

## 1. Arsitektur & Logika Frontend (Client-Side)
Logika saat ini berjalan sepenuhnya di sisi klien (*browser*) menggunakan manipulasi DOM. 

### 1.1. Formatter Mata Uang
* **Fungsi:** `formatRupiah(angka)`
* **Implementasi:** Menggunakan API bawaan JavaScript `Intl.NumberFormat` dengan konfigurasi `id-ID` dan `currency: "IDR"`. Ini memastikan format harga standar industri (contoh: Rp1.100.000,00) tanpa perlu *library* eksternal.

### 1.2. Event Listener Kuantitas
* Menggunakan iterasi `querySelectorAll` pada kelas `.quantity-input`.
* *Trigger*: Event `input` (bereaksi langsung saat pengguna mengetik, tidak perlu menunggu *blur* atau klik di luar).
* *Handling*: Mengambil harga dari atribut data kustom (`data-price`) pada elemen HTML, mengalikannya dengan nilai input, dan merender ulang teks `.subtotal`.

### 1.3. Fungsi `updateCart()`
* Melakukan iterasi ke seluruh elemen baris `.cart-item`.
* Menjumlahkan (`total += harga * qty`) seluruh produk.
* **Fitur Hapus Otomatis:** Menggunakan metode `row.remove()` jika terdeteksi `qty === 0`.
* Menimpa (*overwrite*) teks pada ID `subtotalBox` dan `totalBox` dengan hasil kalkulasi terbaru.

## 2. Catatan Migrasi (Future Backend Integration)
Saat diubah ke Livewire nanti:
* Logika `updateCart()` akan dipindahkan ke *server-side* PHP untuk mencegah manipulasi harga dari *Inspect Element* oleh pengguna.
* Atribut `data-price` akan diganti dengan *state binding* (misal: `wire:model`).
