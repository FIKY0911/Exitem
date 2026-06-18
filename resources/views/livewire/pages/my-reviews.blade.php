<div class="flex flex-col min-h-screen" style="background: #faf8f5;">
    <livewire:components.navbar />

    <main style="padding: 3.5rem 0; flex: 1;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">

            <p style="font-size: 11px; letter-spacing: 0.15em; text-transform: uppercase; color: #9ca3af; margin-bottom: 2.5rem; font-weight: 600;">
                Home <span style="margin: 0 0.5rem; color: #d1d5db;">/</span> Account <span style="margin: 0 0.5rem; color: #d1d5db;">/</span> <span style="color: #DB4444;">My Reviews</span>
            </p>

            <div style="display: flex; gap: 2rem; align-items: flex-start;">
                <x-account-sidebar />

                <div style="flex: 1; min-width: 0; display: flex; flex-direction: column; gap: 1.5rem;">
                    <div style="background: #fff; border-radius: 1.25rem; border: 1px solid #e5e7eb; box-shadow: 0 2px 20px rgba(0,0,0,0.05); overflow: hidden;">
                        <div style="height: 5px; background: linear-gradient(90deg, #DB4444, #e8704a);"></div>
                        <div style="padding: 2.5rem;">
                            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 2rem;">
                                <div style="width: 4px; height: 24px; border-radius: 9999px; background: #DB4444;"></div>
                                <h2 style="font-size: 1.125rem; font-weight: 800; color: #111827;">My Reviews</h2>
                            </div>

                            @if($reviews->count())
                                <div class="space-y-6">
                                    @foreach($reviews as $review)
                                        <div class="border border-gray-100 rounded-lg p-5 hover:border-gray-200 transition-colors bg-gray-50/50">
                                            <div class="flex flex-col sm:flex-row sm:items-start gap-4">
                                                <img src="{{ asset('storage/' . $review->product->thumbnail) }}" class="w-20 h-20 object-cover rounded bg-white border border-gray-100" alt="{{ $review->product->name }}">
                                                <div class="flex-1">
                                                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-2 mb-2">
                                                        <div>
                                                            <a href="{{ route('product.detail', $review->product->slug) }}" class="font-semibold text-gray-900 hover:text-[var(--primary-red)] transition-colors">{{ $review->product->name }}</a>
                                                            <div class="flex items-center gap-1 mt-1">
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-[#FFAD33]' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 24 24">
                                                                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                                                    </svg>
                                                                @endfor
                                                            </div>
                                                        </div>
                                                        <span class="text-xs text-gray-400 whitespace-nowrap">{{ $review->created_at->format('d M Y, H:i') }}</span>
                                                    </div>
                                                    <p class="text-sm text-gray-600 leading-relaxed">{{ $review->comment }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-20 text-gray-400">
                                    <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.175 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.482-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                    </svg>
                                    <p class="text-lg">You haven't written any reviews yet</p>
                                    <a href="{{ route('home') }}" class="mt-4 inline-block px-6 py-3 bg-[#DB4444] text-white rounded text-sm hover:bg-red-600 transition-colors">
                                        Review Products
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
