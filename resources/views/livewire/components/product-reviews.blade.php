<div class="mt-16">
    <div class="flex items-center gap-4 mb-8">
        <span class="inline-block w-5 h-10 bg-[#DB4444] rounded mr-4 align-middle"></span>
        <span class="text-[#DB4444] font-semibold">Reviews</span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        {{-- Summary --}}
        <div class="lg:col-span-1">
            <div class="bg-gray-50 p-8 rounded-lg text-center">
                <h3 class="text-5xl font-bold mb-2">{{ $averageRating }}</h3>
                <div class="flex justify-center mb-2">
                    @for($i = 1; $i <= 5; $i++)
                        <svg class="w-6 h-6 {{ $i <= round($averageRating) ? 'text-[#FFAD33]' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                        </svg>
                    @endfor
                </div>
                <p class="text-gray-500 text-sm">Based on {{ $totalReviews }} reviews</p>
            </div>

            @auth
                <form wire:submit.prevent="submitReview" class="mt-8 space-y-4">
                    <h4 class="font-semibold text-lg">Write a Review</h4>
                    
                    @if(session('review_success'))
                        <div class="p-3 bg-green-100 text-green-700 rounded-md text-sm">
                            {{ session('review_success') }}
                        </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium mb-1">Rating</label>
                        <div class="flex gap-2">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" wire:click="$set('rating', {{ $i }})" class="focus:outline-none transition-transform active:scale-90">
                                    <svg class="w-8 h-8 {{ $i <= $rating ? 'text-[#FFAD33]' : 'text-gray-300' }} hover:text-[#FFAD33] transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                    </svg>
                                </button>
                            @endfor
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Comment</label>
                        <textarea wire:model="comment" rows="4" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:border-[#DB4444] focus:ring-1 focus:ring-[#DB4444]" placeholder="Share your thoughts about this product..."></textarea>
                        @error('comment') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="w-full bg-[#DB4444] text-white py-3 rounded-md font-semibold hover:bg-[#c33b3b] transition-colors shadow-sm hover:shadow-md">
                        Submit Review
                    </button>
                </form>
            @else
                <div class="mt-8 p-6 border border-dashed border-gray-300 rounded-lg text-center bg-white">
                    <p class="text-gray-600 mb-4">Please login to write a review.</p>
                    <a href="{{ route('login') }}" class="text-[#DB4444] font-semibold hover:text-[#c33b3b] transition-colors hover:underline">Login Now</a>
                </div>
            @endauth
        </div>

        {{-- Review List --}}
        <div class="lg:col-span-2 space-y-8">
            @forelse($reviews as $review)
                <div class="border-b pb-8 last:border-0">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center gap-3">
                            @if($review->user->avatar)
                                <img src="{{ asset('storage/' . $review->user->avatar) }}" alt="{{ $review->user->name }}" class="w-10 h-10 rounded-full object-cover shadow-sm border border-gray-100">
                            @else
                                <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center font-bold text-gray-500 border border-gray-100">
                                    {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                </div>
                            @endif
                            <div>
                                <h5 class="font-semibold text-sm sm:text-base">{{ $review->user->name }}</h5>
                                <div class="flex" style="color:#FFAD33">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-3 h-3 {{ $i <= $review->rating ? 'fill-current' : 'text-gray-300' }}" viewBox="0 0 24 24">
                                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <span class="text-gray-400 text-xs">{{ $review->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-gray-600 leading-relaxed">{{ $review->comment }}</p>
                </div>
            @empty
                <div class="text-center py-12 text-gray-500 italic">
                    No reviews yet. Be the first to review this product!
                </div>
            @endforelse
        </div>
    </div>
</div>
