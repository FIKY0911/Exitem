<?php

namespace App\Livewire\Pages;

use App\Mail\ResetPasswordOtpMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ForgotPassword extends Component
{
    public $email;

    public function sendOtp()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = DB::table('users')->where('email', $this->email)->first();

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        DB::table('password_reset_otps')->where('email', $this->email)->delete();

        DB::table('password_reset_otps')->insert([
            'email' => $this->email,
            'otp' => $otp,
            'expires_at' => now()->addMinutes(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $verificationUrl = route('verify-reset-otp', [
            'email' => $this->email,
            'otp' => $otp,
        ]);

        Mail::to($this->email)->send(new ResetPasswordOtpMail($otp, $user->name, $verificationUrl));

        Log::info('Password reset OTP sent.', ['email' => $this->email]);

        return redirect()->route('verify-reset-otp', ['email' => $this->email]);
    }

    public function render()
    {
        return view('livewire.pages.forgot-password')->layout('components.layouts.app');
    }
}
