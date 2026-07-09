<div class="flex flex-col min-h-screen bg-[#faf8f5]">
    <livewire:components.navbar />

    <main class="py-10 sm:py-14 flex-1">
        <div class="max-w-[1200px] mx-auto px-4 sm:px-8">

            <p class="text-[11px] tracking-[0.15em] uppercase text-gray-400 mb-6 sm:mb-10 font-semibold">
                Home <span class="mx-1.5 text-gray-300">/</span> Account <span class="mx-1.5 text-gray-300">/</span> <span class="text-[#DB4444]">My Orders</span>
            </p>

            <div class="flex flex-col lg:flex-row gap-6 lg:gap-8 items-start">
                <x-account-sidebar />

                <div class="flex-1 min-w-0 flex flex-col gap-4 sm:gap-6 w-full">
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-[0_2px_20px_rgba(0,0,0,0.05)] overflow-hidden">
                        <div class="h-[5px] bg-gradient-to-r from-[#DB4444] to-[#e8704a]"></div>
                        <div class="p-5 sm:p-8 lg:p-10">
                            <div class="flex items-center gap-3 mb-6 sm:mb-8">
                                <div class="w-1 h-6 rounded-full bg-[#DB4444]"></div>
                                <h2 class="text-base sm:text-lg font-extrabold text-gray-900">My Orders</h2>
                            </div>

                            {{-- Status Filter --}}
                            <div class="overflow-x-auto scrollbar-hide -mx-5 px-5 sm:px-0 mb-6">
                                <div class="flex gap-2 min-w-max sm:min-w-0">
                                    <button wire:click="filterByStatus('')"
                                            class="px-4 py-2 rounded-lg text-xs font-semibold whitespace-nowrap transition-colors
                                                   {{ !$activeStatus ? 'bg-[#DB4444] text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                        All
                                    </button>
                                    <button wire:click="filterByStatus('paid')"
                                            class="px-4 py-2 rounded-lg text-xs font-semibold whitespace-nowrap transition-colors
                                                   {{ $activeStatus === 'paid' ? 'bg-[#DB4444] text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                        Paid
                                    </button>
                                    <button wire:click="filterByStatus('pending')"
                                            class="px-4 py-2 rounded-lg text-xs font-semibold whitespace-nowrap transition-colors
                                                   {{ $activeStatus === 'pending' ? 'bg-[#DB4444] text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                        Pending
                                    </button>
                                </div>
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
