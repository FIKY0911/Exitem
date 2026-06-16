# Technical Specification: Login Module

Dokumen ini merinci aspek teknis dan arsitektur kode untuk halaman masuk (**Login**) ExItem.

---

## 1. Spesifikasi File
- **File Utama:** `login.html`
- **Style Sheet:** `style.css`
- **Script:** `script.js` (Reference)

## 2. Struktur Data & Form
Halaman ini menggunakan elemen `<form>` dengan ID `loginForm`.

### 2.1 Input Fields
| Field | ID | Type | Atribut | Deskripsi |
| :--- | :--- | :--- | :--- | :--- |
| Email/Phone | `email` | `text` | `required` | Identitas akun pengguna |
| Password | `password` | `password` | `required` | Kata sandi akun |

### 2.2 Komponen Kontrol
- **Submit Button:** `<button type="submit" class="btn-red">`
- **Forget Link:** `<a href="#" class="forget-link">` (Placeholder link untuk pemulihan akun).
- **Message Container:** `<div id="message" class="alert">`

## 3. Dependensi
- **CSS:** Menggunakan `style.css` yang bersifat modular untuk Login dan Signup.
- **Ikonografi:** Font Awesome (CDN) untuk mendukung elemen UI jika diperlukan.

## 4. Perilaku Teknis (Technical Behavior)
- **Form Submission:** Didesain untuk dihandle secara asinkron (AJAX/Fetch) melalui `script.js`.
- **Layout Logic:** Menggunakan `section class="hero"` untuk pembungkus utama guna memastikan form berada di tengah layar secara vertikal dan horizontal.
