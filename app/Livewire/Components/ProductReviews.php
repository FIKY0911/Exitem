<?php

namespace App\Livewire\Components;

use App\Models\Review;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProductReviews extends Component
{
    public $productId;
    public $rating = 5;
    public $comment = '';
    
    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|min:5',
    ];

    public function mount($productId)
    {
        $this->productId = $productId;
    }

    public function submitReview()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->validate();

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $this->productId,
            'rating' => $this->rating,
            'comment' => $this->comment,
        ]);

        $this->reset(['rating', 'comment']);
        session()->flash('review_success', 'Thank you for your review!');
    }

    public function render()
    {
        $reviews = Review::where('product_id', $this->productId)
            ->with('user')
            ->latest()
            ->get();

        $averageRating = $reviews->avg('rating') ?: 0;

        return view('livewire.components.product-reviews', [
            'reviews' => $reviews,
            'averageRating' => number_format($averageRating, 1),
            'totalReviews' => $reviews->count(),
        ]);
    }
}
