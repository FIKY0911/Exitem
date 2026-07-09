<?php

namespace App\Livewire\Pages;

use App\Models\Payment;
use App\Models\Transaction;
use Livewire\Attributes\Poll;
use Livewire\Component;

class PaymentStatusPage extends Component
{
    public string $orderId = '';

    public string $status = 'pending';

    public ?string $paymentType = null;

    public ?int $amount = null;

    public ?string $productName = null;

    public ?int $quantity = null;

    public bool $resolved = false;

    public function mount(string $orderId): void
    {
        $this->orderId = $orderId;
        $this->loadStatus();
    }

    #[Poll(2000)]
    public function loadStatus(): void
    {
        $payment = Payment::where('order_id', $this->orderId)->first();

        if (! $payment) {
            $this->status = 'not_found';
            $this->resolved = true;

            return;
        }

        $this->status = $payment->status;
        $this->paymentType = $payment->payment_type;
        $this->amount = $payment->amount;

        $transaction = Transaction::where('booking_trx_id', $this->orderId)
            ->with('product')
            ->first();

        if ($transaction) {
            $this->productName = $transaction->product?->name;
            $this->quantity = $transaction->quantity;
        }

        if (in_array($this->status, ['paid', 'failed', 'expired'])) {
            $this->resolved = true;
        }
    }

    public function render()
    {
        return view('livewire.pages.payment-status')
            ->layout('components.layouts.app');
    }
}
