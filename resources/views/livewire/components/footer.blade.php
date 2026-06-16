<footer class="bg-black text-white pt-20 pb-6 mt-10">
    <div class="container-max grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10 mb-16">
        <div>
            <h3 class="text-2xl font-bold font-secondary mb-6">Exclusive</h3>
            <h4 class="text-xl font-medium mb-4">Subscribe</h4>
            <p class="mb-4 text-gray-300">Get 10% off your first order</p>
            <div class="relative border border-white rounded-[4px] overflow-hidden w-full max-w-[300px]">
                <input type="email" wire:model="email" placeholder="Enter your email" class="bg-transparent text-white px-4 py-3 outline-none w-full pr-12">
                <button wire:click="subscribe" class="absolute right-0 top-0 bottom-0 px-4 flex items-center justify-center hover:bg-white/10 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </div>
        </div>
        
        <div>
            <h4 class="text-xl font-medium mb-6">Support</h4>
            <ul class="flex flex-col gap-4 text-gray-300">
                <li>111 Bijoy sarani, Dhaka,<br>DH 1515, Bangladesh.</li>
                <li>exclusive@gmail.com</li>
                <li>+88015-88888-9999</li>
            </ul>
        </div>
        
        <div>
            <h4 class="text-xl font-medium mb-6">Account</h4>
            <ul class="flex flex-col gap-4 text-gray-300">
                <li><a href="#" class="hover:text-white transition-colors">My Account</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Login / Register</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Cart</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Wishlist</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Shop</a></li>
            </ul>
        </div>
        
        <div>
            <h4 class="text-xl font-medium mb-6">Quick Link</h4>
            <ul class="flex flex-col gap-4 text-gray-300">
                <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Terms Of Use</a></li>
                <li><a href="#" class="hover:text-white transition-colors">FAQ</a></li>
                <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
            </ul>
        </div>
    </div>
    
    <div class="border-t border-[#141414] pt-6 text-center text-[var(--text-gray)]">
        <p>&copy; Copyright Rimel 2026. All right reserved</p>
    </div>
</footer>
