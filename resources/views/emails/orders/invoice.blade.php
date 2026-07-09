<x-mail::message>
# Invoice for Order #{{ $transaction->booking_trx_id }}

Hello {{ $transaction->name }},

Thank you for your purchase! Your payment via Midtrans has been successfully processed. Here are your invoice details:

### Order Summary

**Order ID:** {{ $transaction->booking_trx_id }}<br>
**Payment Method:** {{ strtoupper(str_replace('_', ' ', $transaction->midtransPayment?->payment_type ?? 'Midtrans')) }}<br>
**Transaction ID:** {{ $transaction->midtransPayment?->transaction_id ?? 'N/A' }}<br>

<x-mail::table>
| Product | Quantity | Total |
| :--- | :---: | :--- |
| {{ $transaction->product->name }} | {{ $transaction->quantity }} | Rp {{ number_format($transaction->grand_total_amount, 0, ',', '.') }} |
</x-mail::table>

### Billing Information

**Name:** {{ $transaction->name }}<br>
**Email:** {{ $transaction->email }}<br>
**Phone:** {{ $transaction->phone }}<br>
**Address:** {{ $transaction->address }}, {{ $transaction->city }}

If you have any questions, please contact our support.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
