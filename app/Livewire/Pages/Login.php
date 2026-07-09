<?php

namespace App\Livewire\Pages;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

class Login extends Component
{
    public $email;

    public $password;

    /**
     * OWASP Implementation:
     * - Validation (Injection prevention)
     * - Rate Limiting (Broken Authentication prevention)
     * - Logging (Insufficient Logging & Monitoring)
     */
    public function login()
    {
        // 1. Rate Limiting (Broken Authentication / Brute Force prevention)
        $throttleKey = 'login-attempt:'.$this->email.'|'.request()->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $this->addError('email', "Too many login attempts. Please try again in {$seconds} seconds.");
            Log::warning('Brute force attempt detected.', ['email' => $this->email, 'ip' => request()->ip()]);

            return;
        }

        // 2. Validation (Injection prevention)
        $this->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            if (Auth::user()->isAdmin()) {
                Auth::logout();
                $this->addError('email', 'Akun admin tidak dapat login di halaman ini. Silakan gunakan Admin Panel.');

                return;
            }

            session()->regenerate();
            RateLimiter::clear($throttleKey);

            Log::info('User logged in.', ['user_id' => Auth::id(), 'ip' => request()->ip()]);

            return redirect()->route('home');
        }

        RateLimiter::hit($throttleKey, 60);
        Log::warning('Failed login attempt.', ['email' => $this->email, 'ip' => request()->ip()]);

        $this->addError('email', 'The provided credentials do not match our records.');
    }

    public function render()
    {
        return view('livewire.pages.login')->layout('components.layouts.app');
    }
}
