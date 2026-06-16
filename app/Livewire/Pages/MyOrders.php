<?php

namespace App\Livewire\Pages;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyOrders extends Component
{
    public function render()
    {
        $orders = [];
        if (Auth::check()) {
            $orders = Transaction::where('email', Auth::user()->email)
                ->with('product')
                ->latest()
                ->get();
        }

        return view('livewire.pages.my-orders', [
            'orders' => $orders
        ])->layout('components.layouts.app');
    }
}
