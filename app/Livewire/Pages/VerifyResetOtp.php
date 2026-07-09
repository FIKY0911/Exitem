<?php

namespace App\Livewire\Pages;

use App\Mail\ResetPasswordOtpMail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class VerifyResetOtp extends Component
{
    public $email;
    public $otp;
    public $password;
    public $password_confirmation;
    public $step = 'verify';

    public function mount()
    {
        $this->email = request()->query('email', '');

        if (blank($this->email)) {
            return redirect()->route('forgot-password');
        }

        $existing = DB::table('users')->where('email', $this->email)->exists();
        if (!$existing) {
            return redirect()->route('forgot-password');
        }

        $otpFromQuery = request()->query('otp');
        if ($otpFromQuery) {
            $this->otp = $otpFromQuery;
            $this->verifyOtp();
        }
    }

    public function verifyOtp()
    {
        $lockoutKey = 'otp_attempts:' . $this->email;

        if (Cache::has($lockoutKey . '_lockout')) {
            $seconds = Cache::get($lockoutKey . '_lockout') - now()->timestamp;
            $minutes = ceil($seconds / 60);
            $this->addError('otp', "Too many failed attempts. Please wait {$minutes} minutes before trying again.");
            return;
        }

        $this->validate([
            'otp' => 'required|string|size:6',
        ]);

        $record = DB::table('password_reset_otps')
            ->where('email', $this->email)
            ->where('otp', $this->otp)
            ->first();

        if (!$record) {
            $attempts = Cache::get($lockoutKey, 0) + 1;
            Cache::put($lockoutKey, $attempts, now()->addMinutes(15));

            if ($attempts >= 5) {
                Cache::put($lockoutKey . '_lockout', now()->addMinutes(15)->timestamp, now()->addMinutes(15));
                $this->addError('otp', 'Too many failed attempts. Please wait 15 minutes before trying again.');
            } else {
                $this->addError('otp', 'Invalid OTP. Please try again.');
            }
            return;
        }

        if (now()->greaterThan($record->expires_at)) {
            $this->addError('otp', 'OTP has expired. Please request a new one.');
            return;
        }

        Cache::forget($lockoutKey);
        Cache::forget($lockoutKey . '_lockout');

        $this->step = 'reset';
        $this->otp = '';
    }

    public function resetPassword()
    {
        $this->validate([
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ],
        ]);

        $user = DB::table('users')->where('email', $this->email)->first();

        if (!$user) {
            $this->addError('password', 'User not found.');
            return;
        }

        DB::table('users')
            ->where('email', $this->email)
            ->update(['password' => Hash::make($this->password)]);

        DB::table('password_reset_otps')->where('email', $this->email)->delete();

        Log::info('Password reset successful.', ['email' => $this->email]);

        session()->flash('status', 'Password has been reset successfully. Please login with your new password.');

        return redirect()->route('login');
    }

    public function resendOtp()
    {
        $record = DB::table('password_reset_otps')
            ->where('email', $this->email)
            ->first();

        if ($record && $record->created_at > now()->subMinutes(1)) {
            $this->addError('otp', 'Please wait at least 1 minute before requesting a new OTP.');
            return;
        }

        try {
            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

            DB::table('password_reset_otps')->where('email', $this->email)->delete();

            DB::table('password_reset_otps')->insert([
                'email'      => $this->email,
                'otp'        => $otp,
                'expires_at' => now()->addMinutes(3),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $user = DB::table('users')->where('email', $this->email)->first();
            $verificationUrl = route('verify-reset-otp', [
                'email' => $this->email,
                'otp'   => $otp,
            ]);

            Mail::to($this->email)->send(new ResetPasswordOtpMail($otp, $user->name ?? 'User', $verificationUrl));

            session()->flash('resent', 'A new OTP has been sent to ' . $this->email . '.');
        } catch (\Exception $e) {
            Log::error('Resend OTP failed: ' . $e->getMessage());
            $this->addError('otp', 'Failed to resend OTP. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.pages.verify-reset-otp')->layout('components.layouts.app');
    }
}
