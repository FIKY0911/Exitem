# 🛠️ Technical Specification (Tech Spec)
**Project Name:** Exclusive E-Commerce
**Module:** Homepage (Landing Page)
**Stack:** Laravel 12 + Livewire 3 (TALL Stack)

## 1. Arsitektur Komponen Livewire
Untuk menjaga kode tetap bersih (*clean code*) dan *reusable*, pengembangan modul *Homepage* menerapkan prinsip dekomposisi komponen.

### 1.1. Full-Page Component (Controller Utama)
* `app/Livewire/Pages/Home.php`: Menangani *business logic* untuk mengambil seluruh data agregat yang dibutuhkan di *Homepage*.

### 1.2. Nested Components (Presentational/UI)
Komponen modular yang disuntikkan ke dalam halaman utama:
* `livewire.components.navbar`: Mengurus *state* pencarian dinamis dan angka pada keranjang.
* `livewire.components.hero-banner`: Menampilkan data promo aktif.
* `livewire.components.product-card`: Komponen *reusable* untuk merender item produk secara individual beserta logika *event* `addToCart`.
* `livewire.components.footer`: Menangani tampilan statis dan aksi berlangganan (*subscribe*).

## 2. Kebutuhan Data & Query (Business Logic)
Komponen `Home.php` bertanggung jawab mengeksekusi *query* ke *database* via Eloquent ORM. 

| Kebutuhan UI | Logika Query (Eloquent) |
| :--- | :--- |
| **Sidebar & Grid Kategori** | `Category::select('id', 'name', 'icon')->take(8)->get()` |
| **Hero Banner** | `Promotion::where('is_active', true)->latest()->first()` |
| **Best Selling Products** | `Product::withCount('orders')->orderBy('orders_count', 'desc')->take(4)->get()` |
| **Explore Products** | `Product::inRandomOrder()->take(8)->get()` |
| **New Arrivals** | `Product::where('is_featured', true)->latest()->take(4)->get()` |

## 3. Implementasi Kode (Industry Standard)

Pemisahan *logic* pengambilan data dari tampilan (*view*) dilakukan dengan memanfaatkan fitur `#[Computed]` dari Livewire 3.

### 3.1. Business Logic Layer (`app/Livewire/Pages/Home.php`)
Penggunaan atribut `#[Computed]` mengoptimalkan *query* dan melakukan *caching* ringan dalam satu siklus *request* sehingga performa halaman tetap cepat.

```php
<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Category;
use App\Models\Product;

class Home extends Component
{
    #[Computed]
    public function categories()
    {
        return Category::limit(6)->get();
    }

    #[Computed]
    public function bestSellingProducts()
    {
        // Mengambil produk yang ditandai sebagai unggulan/terlaris
        return Product::where('is_featured', true)->take(4)->get();
    }

    #[Computed]
    public function exploreProducts()
    {
        return Product::latest()->take(4)->get();
    }

    public function render()
    {
        return view('livewire.pages.home')->layout('components.layouts.app');
    }
}
