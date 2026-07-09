<?php

namespace App\Livewire\Pages;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Livewire\Component;

class Signup extends Component
{
    public $name;
    public $phone;
    public $identifier; // Email
    public $password;

    /**
     * OWASP Implementation: 
     * - Validation (Injection prevention)
     * - Rate Limiting (Broken Authentication prevention)
     * - Secure Hashing (Broken Authentication)
     * - Logging (Insufficient Logging & Monitoring)
     */
    public function signup()
    {
        // 1. Rate Limiting (Prevention against automated attacks)
        $throttleKey = 'signup-attempt:' . request()->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $this->addError('identifier', "Too many signup attempts. Please try again in {$seconds} seconds.");
            return;
        }

        // 2. Strict Validation (Prevention against Injection and XSS)
        $validated = $this->validate([
            'name' => 'required|string|min:3|max:100',
            'phone' => 'required|string|regex:/^[0-9\-\+\s]+$/|min:10|max:15',
            'identifier' => 'required|email|max:255|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:255',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
            ],
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, and one number.'
        ]);

        try {
            // 3. Backend Token Generation (as requested)
            // "buat password menggunakan token acak dan diperkuat lagi dengan kunci tambahan 10 digit random"
            $token = Str::random(16);
            $extraKey = (string) random_int(1000000000, 9999999999);
            $backendToken = $token . $extraKey;

            // 4. Secure Data Persistence (Sensitive Data Exposure prevention)
            $user = User::create([
                'name' => strip_tags($this->name), // Extra XSS protection
                'email' => $this->identifier,
                'phone' => $this->phone,
                'password' => Hash::make($this->password),
                'password_token' => $backendToken,
                'role' => 'user',
            ]);

            RateLimiter::clear($throttleKey);

            // 5. Logging (Logging & Monitoring)
            Log::info('User registered successfully.', ['user_id' => $user->id, 'ip' => request()->ip()]);

            Auth::login($user);

            return redirect()->route('home');

        } catch (\Exception $e) {
            // 6. Error Handling (Security Misconfiguration prevention - don't leak stack trace)
            Log::error('Signup failed: ' . $e->getMessage(), ['ip' => request()->ip()]);
            $this->addError('identifier', 'An error occurred during signup. Please try again later.');
            RateLimiter::hit($throttleKey, 60);
        }
    }

    public function render()
    {
        return view('livewire.pages.signup')->layout('components.layouts.app');
    }
}
