# 🛠️ Technical Specification (Tech Spec)
**Project Name:** ExItem E-Commerce
**Module:** Product Detail Page (PDP)
**Stack:** Laravel 12 + Livewire 3 + Alpine.js
**Document Version:** 1.0

## 1. Arsitektur Komponen
Untuk memisahkan *business logic* dan *presentational logic*, pengembangan menggunakan pendekatan TALL Stack standar industri.

### 1.1. Full-Page Component (Business Logic Layer)
* `app/Livewire/Pages/ProductDetail.php`: Mengurus *query database* berdasarkan parameter URL (*slug*) dan menangani aksi *backend* seperti menambahkan barang ke keranjang (*cart*).

### 1.2. State Management (Client vs Server)
* **Livewire State (Server):** Menyimpan data yang wajib diproses oleh sistem PHP (ID Produk, Warna yang dipilih pengguna, Ukuran yang dipilih, dan fungsi eksekusi *Buy Now*).
* **Alpine.js State (Client):** Menyimpan data yang murni untuk reaktivitas antarmuka (Gambar *gallery* mana yang sedang aktif, status angka pada input *quantity* sebelum dikirim ke *server*).

## 2. Kebutuhan Data & Skema (Eloquent ORM)
Komponen ini membutuhkan relasi tabel sebagai berikut:
* `Product`: Memuat `name`, `price`, `description`, `stock_status`.
* `ProductImage`: Memuat `url`, `is_primary`. (Relasi: *Product Has Many ProductImages*).
* `Review`: Memuat skor untuk agregasi *rating*.

## 3. Implementasi Kode
Menggantikan DOM *manipulation* manual (*Vanilla JS*) dengan *data binding* deklaratif menggunakan Livewire dan Alpine.js untuk mencegah bentrok siklus *render*.

### 3.1. Backend / Framework Logic (`app/Livewire/Pages/ProductDetail.php`)
```php
<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Product;

class ProductDetail extends Component
{
    public Product $product;
    
    // State Livewire untuk mencatat pilihan pengguna
    public $selectedColor = null;
    public $selectedSize = 'M'; // Nilai default

    public function mount($slug)
    {
        // Pengambilan data menggunakan Eager Loading untuk mencegah N+1 Query problem
        $this->product = Product::with(['images', 'relatedProducts'])
                                ->where('slug', $slug)
                                ->firstOrFail();
    }

    public function buyNow($quantity)
    {
        $this->validate([
            'selectedColor' => 'required',
            'selectedSize' => 'required',
        ]);

        // Proses bisnis memindahkan data ke Cart session/database dilakukan di sini
        // CartService::add($this->product, $quantity, $this->selectedColor, $this->selectedSize);

        return redirect()->route('checkout');
    }

    public function render()
    {
        return view('livewire.pages.product-detail')->layout('components.layouts.app');
    }
}
