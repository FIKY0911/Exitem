# Feature Documentation

## Laravel Midtrans Payment System

# Overview

Fitur pembayaran menggunakan Midtrans Snap Redirect.

User akan diarahkan ke halaman pembayaran Midtrans dan status transaksi akan diperbarui melalui webhook.

---

# Features

## Create Payment

Membuat transaksi baru dan mendapatkan Redirect URL.

Output:

```json
{
  "redirect_url": "..."
}
```

---

## Payment Redirect

User diarahkan ke halaman pembayaran Midtrans.

Metode pembayaran:

* QRIS
* GoPay
* ShopeePay
* Bank Transfer
* Virtual Account
* Credit Card

---

## Webhook Notification

Midtrans mengirim notifikasi ke Laravel ketika status pembayaran berubah.

Endpoint:

```http
POST /midtrans/webhook
```

---

## Transaction History

Menyimpan:

* Order ID
* Transaction ID
* Amount
* Payment Type
* Status
* Payload Midtrans

---

# Redirect Pages

## Success

```text
/payment/success
```

Status:

```text
Payment Successful
```

---

## Pending

```text
/payment/pending
```

Status:

```text
Waiting For Payment
```

---

## Failed

```text
/payment/failed
```

Status:

```text
Payment Failed
```

---

# Midtrans Dashboard Setup

## Access Keys

Settings
→ Access Keys

Ambil:

* Server Key
* Client Key

---

## Notification URL

Settings
→ Configuration

```text
https://domain.com/midtrans/webhook
```

---

## Redirect URL

Settings
→ Configuration

```text
Finish URL
https://domain.com/payment/success

Unfinish URL
https://domain.com/payment/pending

Error URL
https://domain.com/payment/failed
```

---

# Sandbox Testing

## Test Credit Card

```text
Card Number : 4811 1111 1111 1114

CVV : 123

OTP : 112233
```

---

# Best Practices

* Simpan transaksi sebelum meminta Snap Token.
* Gunakan UUID untuk Order ID.
* Validasi Signature Key.
* Gunakan HTTPS.
* Gunakan DB::transaction().
* Jangan mempercayai callback frontend.
* Gunakan webhook sebagai sumber status pembayaran utama.
