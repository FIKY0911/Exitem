# 🛠️ Technical Specification (Tech Spec)
**Module:** Checkout & Billing
**Stack:** HTML, CSS, JavaScript (Vanilla ES6+)
**Document Version:** 1.0

## 1. Arsitektur Frontend
### 1.1. Dynamic Payment UI
* Menggunakan *Event Listener* `change` pada elemen input *Radio Button* (ID: `bank`, `cod`, `qris`).
* Memanipulasi properti CSS `display` pada elemen `bankInfo` (beralih antara `block` dan `none`) berdasarkan metode yang dipilih.

### 1.2. Validasi Formulir `handleCheckout()`
* Menggunakan `.trim()` saat mengambil *value* input untuk mencegah pengguna hanya memasukkan karakter spasi kosong.
* Mengatur ulang (mereset) semua teks eror (`innerText = ""`) di awal eksekusi fungsi agar pesan eror lama tidak tertinggal.
* **Logika Pengecekan:**
  * Menggunakan variabel *flag* `let valid = true`.
  * Mengecek kekosongan input dengan negasi `!firstName`.
  * **Regular Expression (Regex):** Menggunakan `/^[0-9]+$/` dan metode `.test()` untuk memastikan kolom telepon hanya berisi angka minimal 1 digit.
  * Validasi *Radio Button*: `document.querySelector('input[name="payment"]:checked')` untuk mendeteksi apakah ada metode yang sudah dipilih.
* Jika `valid === true`, sistem akan menampilkan *alert* konfirmasi sukses.

## 2. Rekomendasi Skalabilitas 
Meskipun validasi sisi klien (*JavaScript*) sudah baik untuk pengalaman pengguna (UX), validasi akhir tetap harus dilakukan di sisi *server* menggunakan *Request Validation* Laravel untuk mencegah serangan *bypass* JavaScript.
