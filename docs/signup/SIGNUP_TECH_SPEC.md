# Technical Specification: Signup Module

Dokumen ini merinci aspek teknis dan arsitektur kode untuk halaman pendaftaran (**Signup**) ExItem.

---

## 1. Spesifikasi File
- **File Utama:** `signup.html`
- **Style Sheet:** `style.css`
- **Script:** `script.js` (Reference)

## 2. Struktur Data & Form
Halaman ini menggunakan elemen `<form>` dengan ID `signupForm`.

### 2.1 Input Fields
| Field | ID | Type | Atribut | Deskripsi |
| :--- | :--- | :--- | :--- | :--- |
| Name | `name` | `text` | `required` | Nama lengkap pengguna |
| Identifier | `identifier` | `text` | `required` | Email atau Nomor Telepon |
| Password | `password` | `password` | `required` | Kata sandi akun |

### 2.2 Komponen Feedback
- **Message Container:** `<div id="message" class="alert">`
- **Tujuan:** Menampilkan pesan error validasi atau sukses pendaftaran secara dinamis via JavaScript.

## 3. Dependensi
- **Font Awesome 6.0.0:** Digunakan untuk elemen ikon visual (Link CDN).
- **Google Fonts:** Mengimpor font 'Poppins' melalui CSS.

## 4. Perilaku Teknis (Technical Behavior)
- **Validasi HTML5:** Semua input menggunakan atribut `required`.
- **Navigation:** Tautan di bagian bawah mengarah ke `login.html` untuk user yang sudah memiliki akun.
- **Navbar State:** Menambahkan class `.active` pada link "Sign Up".
