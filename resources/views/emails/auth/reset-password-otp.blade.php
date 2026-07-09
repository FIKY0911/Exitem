<x-mail::message>
# Reset Password OTP

Hi {{ $name }},

You requested to reset your password. Use the OTP below or click the button to verify:

<div style="text-align: center; margin: 30px 0;">
    <span style="font-size: 32px; font-weight: 800; letter-spacing: 8px; color: #DB4444;">{{ $otp }}</span>
</div>

This OTP will expire in **3 minutes**.

<x-mail::button :url="$verificationUrl">
Verify OTP
</x-mail::button>

If you did not request a password reset, please ignore this email.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
