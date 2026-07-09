<?php

namespace App\Livewire\Pages;

use App\Models\Product;
use Livewire\Component;

class SearchResults extends Component
{
    public $query = '';

    public function mount($q = '')
    {
        $this->query = $q;
    }

    public function render()
    {
        $products = [];
        
        if (trim($this->query)) {
            $products = Product::where('name', 'like', '%' . $this->query . '%')
                ->orWhere('about', 'like', '%' . $this->query . '%')
                ->orWhereHas('category', function($q) {
                    $q->where('name', 'like', '%' . $this->query . '%');
                })
                ->orWhereHas('brand', function($q) {
                    $q->where('name', 'like', '%' . $this->query . '%');
                })
                ->with(['category', 'brand'])
                ->paginate(12);
        }

        return view('livewire.pages.search-results', [
            'products' => $products
        ])->layout('components.layouts.app');
    }
}
