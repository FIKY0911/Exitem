<div>
    <livewire:components.navbar :dark="true" />

    <main class="auth-page py-20">
        <div class="auth-container">
            <h1 class="auth-header">Sign Up</h1>
            
            @if ($errors->any())
                <div class="alert-auth alert-auth-error mb-6">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form wire:submit.prevent="signup" class="auth-form" autocomplete="off">
                @csrf
                <div class="input-group">
                    <input type="text" wire:model="name" placeholder="Full Name" required>
                </div>
                <div class="input-group">
                    <input type="text" wire:model="phone" placeholder="Phone Number (e.g. 08123456789)" required>
                </div>
                <div class="input-group">
                    <input type="email" wire:model="identifier" placeholder="Email Address" required>
                </div>
                <div class="input-group relative" x-data="{ show: false }">
                    <input :type="show ? 'text' : 'password'" wire:model="password" placeholder="Password (Min. 8 characters)" required class="w-full pr-10">
                    <button type="button" @click="show = !show" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                        <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg x-show="show" x-cloak style="display: none;" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 011.51-2.936m2.53-2.53A10.05 10.05 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.05 10.05 0 01-1.51 2.936m-2.53 2.53A10.05 10.05 0 0112 19M3 3l18 18" />
                        </svg>
                    </button>
                </div>

                <div class="auth-action-row">
                    <button type="submit" class="btn-auth">Create Account</button>
                    <a href="{{ route('login') }}" class="auth-link">Already have an account?</a>
                </div>
            </form>
        </div>
    </main>

    <livewire:components.footer />
</div>
