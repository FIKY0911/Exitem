<?php

namespace App\Livewire\Pages;

use App\Models\Wishlist;
use Livewire\Component;

class MyCollection extends Component
{
    public function removeFromCollection($wishlistId)
    {
        Wishlist::find($wishlistId)?->delete();
        $this->dispatch('wishlist-updated');
    }

    public function render()
    {
        $collection = Wishlist::where('session_id', session()->getId())
            ->with('product')
            ->latest()
            ->get();

        return view('livewire.pages.my-collection', [
            'collection' => $collection
        ])->layout('components.layouts.app');
    }
}
