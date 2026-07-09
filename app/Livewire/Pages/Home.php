<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;

class Home extends Component
{
    #[Url(as: 'category')]
    public $selectedCategorySlug = null;

    public $exploreLimit = 8;

    #[On('echo:admin-updates,.data.updated')]
    public function refreshData()
    {
        // Livewire will automatically re-render and re-calculate computed properties
    }

    public function selectCategory($slug = null)
    {
        $this->selectedCategorySlug = $slug;
        $this->dispatch('scroll-to-products');
    }

    public function loadMore()
    {
        $this->exploreLimit += 8;
    }

    #[Computed]
    public function categories()
    {
        return Category::all();
    }

    #[Computed]
    public function selectedCategory()
    {
        if (!$this->selectedCategorySlug) return null;
        return Category::where('slug', $this->selectedCategorySlug)->first();
    }

    #[Computed]
    public function filteredProducts()
    {
        if (!$this->selectedCategorySlug) return collect();

        // Jika kategori 'Other' dipilih, tampilkan semua produk
        if ($this->selectedCategorySlug === 'other') {
            return Product::latest()->get();
        }
        
        return Product::whereHas('category', function($query) {
            $query->where('slug', $this->selectedCategorySlug);
        })->latest()->get();
    }

    #[Computed]
    public function productsByCategory()
    {
        return Category::with(['products' => function($query) {
            $query->latest()->take(4);
        }])->has('products')->get();
    }

    #[Computed]
    public function bestSellingProducts()
    {
        // Get products based on total quantity sold in successful transactions
        return Product::select('products.*')
            ->join('transactions', 'products.id', '=', 'transactions.product_id')
            ->where('transactions.is_paid', true)
            ->groupBy('products.id')
            ->selectRaw('SUM(transactions.quantity) as total_sold')
            ->orderByDesc('total_sold')
            ->take(4)
            ->get();
    }

    #[Computed]
    public function exploreProducts()
    {
        // Show all products, ordered by latest
        return Product::latest()->take($this->exploreLimit)->get();
    }

    #[Computed]
    public function newArrivals()
    {
        return Product::latest()->take(4)->get();
    }

    public function render()
    {
        return view('livewire.pages.home')->layout('components.layouts.app');
    }
}
