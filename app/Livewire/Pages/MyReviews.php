<?php

namespace App\Livewire\Pages;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyReviews extends Component
{
    public function render()
    {
        $reviews = [];
        if (Auth::check()) {
            $reviews = Review::where('user_id', Auth::id())
                ->with('product')
                ->latest()
                ->get();
        }

        return view('livewire.pages.my-reviews', [
            'reviews' => $reviews
        ])->layout('components.layouts.app');
    }
}
