<?php

namespace App\Livewire\Components;

use App\Models\Product;
use App\Models\Wishlist;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

class Navbar extends Component
{
    public string $search = '';
    public bool $dark = false;
    public $suggestions = [];

    #[On('cart-updated')]
    #[On('wishlist-updated')]
    #[On('collection-updated')]
    public function refreshCounts(): void
    {
        // triggers re-render with fresh counts
    }

    public function updatedSearch()
    {
        if (strlen($this->search) >= 2) {
            $this->suggestions = Product::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('about', 'like', '%' . $this->search . '%')
                ->orWhereHas('category', function($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('brand', function($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                })
                ->limit(5)
                ->get(['id', 'name', 'slug', 'price', 'thumbnail'])
                ->toArray();
        } else {
            $this->suggestions = [];
        }
    }

    public function performSearch()
    {
        if (trim($this->search)) {
            $this->suggestions = [];
            return redirect()->route('search', ['q' => $this->search]);
        }
    }

    public function logout()
    {
        \Illuminate\Support\Facades\Auth::guard('web')->logout();
        
        // Gunakan regenerate() alih-alih invalidate() agar sesi dari guard lain (seperti admin) tidak ikut terhapus.
        session()->regenerate();

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.components.navbar', [
            'cartCount'     => app(CartService::class)->count(),
            'wishlistCount' => Wishlist::where('session_id', session()->getId())->count(),
        ]);
    }
}
