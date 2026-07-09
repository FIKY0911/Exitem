# Product Requirement Document

## Midtrans Payment Integration for Laravel

## Objective

Mengintegrasikan Midtrans Payment Gateway ke dalam aplikasi Laravel untuk mendukung pembayaran produk, top-up saldo, dan transaksi lainnya secara aman dan otomatis.

---

# Goals

## Business Goals

* Mendukung berbagai metode pembayaran.
* Mempermudah proses checkout.
* Mengurangi kegagalan pembayaran.
* Mempercepat konfirmasi pembayaran.

## User Goals

* Melakukan pembayaran dengan mudah.
* Mendapatkan status pembayaran secara real-time.
* Mendapatkan pengalaman checkout yang aman.

---

# User Stories

## Customer

Sebagai pengguna:

* Saya ingin melakukan pembayaran menggunakan QRIS.
* Saya ingin menggunakan E-Wallet.
* Saya ingin menggunakan Transfer Bank.
* Saya ingin mengetahui status pembayaran saya.

## Administrator

Sebagai admin:

* Saya ingin menerima notifikasi pembayaran otomatis.
* Saya ingin status transaksi diperbarui otomatis.
* Saya ingin menyimpan histori transaksi.

---

# User Flow

1. User memilih produk.
2. User klik Checkout.
3. Laravel membuat transaksi.
4. Laravel meminta Snap Token ke Midtrans.
5. Laravel menerima Redirect URL.
6. User diarahkan ke halaman pembayaran Midtrans.
7. User menyelesaikan pembayaran.
8. Midtrans mengirim webhook ke Laravel.
9. Laravel memvalidasi Signature Key.
10. Laravel mengubah status transaksi.
11. User diarahkan ke halaman Success, Pending, atau Failed.

---

# Functional Requirements

## Payment Creation

* Generate Order ID unik.
* Generate Snap Token.
* Generate Redirect URL.

## Payment Processing

* Redirect ke halaman pembayaran Midtrans.
* Mendukung seluruh metode pembayaran yang aktif.

## Webhook Processing

* Menerima notifikasi Midtrans.
* Memvalidasi Signature Key.
* Memperbarui status pembayaran.

## Transaction Tracking

* Menyimpan seluruh histori transaksi.
* Menyimpan payload Midtrans.

---

# Non Functional Requirements

## Security

* Server Key hanya berada di backend.
* HTTPS wajib digunakan.
* Validasi Signature Key wajib.

## Reliability

* Atomic database transaction.
* Idempotent webhook handling.

## Performance

* Generate token < 3 detik.
* Webhook processing < 5 detik.
