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
        // Get products marked as popular
        return Product::where('is_popular', true)->take(4)->get();
    }

    #[Computed]
    public function exploreProducts()
    {
        return Product::inRandomOrder()->take(8)->get();
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
