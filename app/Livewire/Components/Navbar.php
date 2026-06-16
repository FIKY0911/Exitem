<?php

namespace App\Livewire\Components;

use App\Models\Wishlist;
use App\Services\CartService;
use Livewire\Component;

class Navbar extends Component
{
    public string $search = '';
    public bool $dark = false;

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
