<?php

namespace App\Livewire\Pages;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Products extends Component
{
    use WithPagination;

    #[On('echo:admin-updates,.data.updated')]
    public function refreshData()
    {
        // Refresh data
    }

    public function render()
    {
        $products = Product::with(['category', 'brand'])->paginate(12);

        return view('livewire.pages.products', [
            'products' => $products
        ])->layout('components.layouts.app');
    }
}
