<?php

namespace App\Livewire\Pages;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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
        $this->validate([
            'otp' => 'required|string|size:6',
        ]);

        $record = DB::table('password_reset_otps')
            ->where('email', $this->email)
            ->where('otp', $this->otp)
            ->first();

        if (!$record) {
            $this->addError('otp', 'Invalid OTP. Please try again.');
            return;
        }

        if (now()->greaterThan($record->expires_at)) {
            $this->addError('otp', 'OTP has expired. Please request a new one.');
            return;
        }

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

    public function render()
    {
        return view('livewire.pages.verify-reset-otp')->layout('components.layouts.app');
    }
}
