<div class="flex flex-col min-h-screen" style="background: #faf8f5;">
    <livewire:components.navbar />

    <main style="padding: 3.5rem 0; flex: 1;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">

            <p style="font-size: 11px; letter-spacing: 0.15em; text-transform: uppercase; color: #9ca3af; margin-bottom: 2.5rem; font-weight: 600;">
                Home <span style="margin: 0 0.5rem; color: #d1d5db;">/</span> Account <span style="margin: 0 0.5rem; color: #d1d5db;">/</span> <span style="color: #DB4444;">My Orders</span>
            </p>

            <div style="display: flex; gap: 2rem; align-items: flex-start;">
                <x-account-sidebar />

                <div style="flex: 1; min-width: 0; display: flex; flex-direction: column; gap: 1.5rem;">
                    <div style="background: #fff; border-radius: 1.25rem; border: 1px solid #e5e7eb; box-shadow: 0 2px 20px rgba(0,0,0,0.05); overflow: hidden;">
                        <div style="height: 5px; background: linear-gradient(90deg, #DB4444, #e8704a);"></div>
                        <div style="padding: 2.5rem;">
                            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 2rem;">
                                <div style="width: 4px; height: 24px; border-radius: 9999px; background: #DB4444;"></div>
                                <h2 style="font-size: 1.125rem; font-weight: 800; color: #111827;">My Orders</h2>
                            </div>

                            @if($orders->count())
                                <div class="overflow-x-auto border border-gray-100 rounded-lg">
                                    <table class="w-full text-left text-sm">
                                        <thead class="bg-gray-50 text-gray-700 uppercase font-medium">
                                            <tr>
                                                <th class="px-6 py-4">Transaction ID</th>
                                                <th class="px-6 py-4">Product</th>
                                                <th class="px-6 py-4">Total Amount</th>
                                                <th class="px-6 py-4">Status</th>
                                                <th class="px-6 py-4 text-right">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-100">
                                            @foreach($orders as $order)
                                                <tr class="hover:bg-gray-50 transition-colors">
                                                    <td class="px-6 py-4 font-semibold text-gray-900">#{{ $order->booking_trx_id }}</td>
                                                    <td class="px-6 py-4">
                                                        <div class="flex items-center gap-3">
                                                            <img src="{{ asset('storage/' . $order->product->thumbnail) }}" class="w-12 h-12 object-contain rounded bg-gray-50" alt="{{ $order->product->name }}">
                                                            <div>
                                                                <p class="font-medium text-gray-900">{{ $order->product->name }}</p>
                                                                <p class="text-xs text-gray-500">Qty: {{ $order->quantity }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 font-medium">Rp {{ number_format($order->grand_total_amount, 0, ',', '.') }}</td>
                                                    <td class="px-6 py-4">
                                                        @if($order->is_paid)
                                                            <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-xs font-semibold">Paid</span>
                                                        @else
                                                            <span class="px-3 py-1 bg-yellow-100 text-yellow-600 rounded-full text-xs font-semibold">Pending</span>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 text-right text-gray-500">{{ $order->created_at->format('d M Y') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-20 text-gray-400">
                                    <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                    </svg>
                                    <p class="text-lg">You haven't placed any orders yet</p>
                                    <a href="{{ route('home') }}" class="mt-4 inline-block px-6 py-3 bg-[#DB4444] text-white rounded text-sm hover:bg-red-600 transition-colors">
                                        Start Shopping
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <livewire:components.footer />
</div>
