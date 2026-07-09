<?php

namespace App\Livewire\Pages;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyOrders extends Component
{
    public string $activeStatus = '';

    public function filterByStatus(string $status): void
    {
        $this->activeStatus = $this->activeStatus === $status ? '' : $status;
    }

    public function render()
    {
        $orders = [];
        if (Auth::check()) {
            $orders = Transaction::where('email', Auth::user()->email)
                ->with('product')
                ->when($this->activeStatus === 'paid', function ($q) {
                    $q->where('is_paid', true);
                })
                ->when($this->activeStatus === 'pending', function ($q) {
                    $q->where('is_paid', false);
                })
                ->latest()
                ->get();
        }

        return view('livewire.pages.my-orders', [
            'orders' => $orders
        ])->layout('components.layouts.app');
    }
}
