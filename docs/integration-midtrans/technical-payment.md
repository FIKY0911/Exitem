# Technical Specification

## Laravel Midtrans Integration

# Technology Stack

* Laravel 12+
* PHP 8.3+
* MySQL/PostgreSQL
* Midtrans PHP SDK

---

# Installation

```bash
composer require midtrans/midtrans-php
```

---

# Environment Variables

```env
MIDTRANS_SERVER_KEY=SB-Mid-server-xxxxxxxx

MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxxxxxx

MIDTRANS_IS_PRODUCTION=false

MIDTRANS_IS_SANITIZED=true

MIDTRANS_IS_3DS=true
```

---

# Midtrans Configuration

config/midtrans.php

```php
return [

    'server_key' => env('MIDTRANS_SERVER_KEY'),

    'client_key' => env('MIDTRANS_CLIENT_KEY'),

    'is_production' => env('MIDTRANS_IS_PRODUCTION'),

    'is_sanitized' => env('MIDTRANS_IS_SANITIZED'),

    'is_3ds' => env('MIDTRANS_IS_3DS'),

];
```

---

# API Endpoints

## Checkout

```http
POST /checkout
```

Request

```json
{
  "amount": 100000
}
```

Response

```json
{
  "redirect_url": "https://app.sandbox.midtrans.com/..."
}
```

---

# Webhook Endpoint

```http
POST /midtrans/webhook
```

---

# Database Schema

payments

```sql
id BIGINT
order_id VARCHAR(100)
transaction_id VARCHAR(100)
amount DECIMAL(12,2)
payment_type VARCHAR(50)
status VARCHAR(50)
snap_token TEXT
redirect_url TEXT
payload JSON
created_at TIMESTAMP
updated_at TIMESTAMP
```

---

# Transaction Status Mapping

| Midtrans   | Internal  |
| ---------- | --------- |
| settlement | paid      |
| capture    | paid      |
| pending    | pending   |
| expire     | expired   |
| cancel     | cancelled |
| deny       | failed    |
| failure    | failed    |

---

# Security

## Server Key

Disimpan pada:

```env
MIDTRANS_SERVER_KEY
```

Tidak boleh diakses frontend.

---

## Signature Validation

```php
$signatureKey = hash(
    'sha512',
    $orderId .
    $statusCode .
    $grossAmount .
    env('MIDTRANS_SERVER_KEY')
);
```

---

# Database Transaction

```php
DB::transaction(function () {

    // update payment

    // update user balance

    // create transaction log

});
```

---

# Redirect Configuration

Midtrans Dashboard

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
