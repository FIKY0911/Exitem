<?php

namespace App\Livewire\Pages;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class MyAccount extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $phone;
    public $avatar;
    public $existingAvatar;
    
    

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->existingAvatar = $user->avatar;
    }

    public function updatedAvatar()
    {
        $this->validate(['avatar' => 'nullable|image|max:2048']);
        $this->dispatch('avatar-uploaded');
    }

    public function updateProfile()
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
        ]);

        // XSS Protection - sanitize input
        $validated['name'] = strip_tags($validated['name']);
        $validated['phone'] = strip_tags($validated['phone'] ?? '');

        if ($this->avatar && is_object($this->avatar)) {
            // File Upload Security - validate mime type
            $this->validate([
                'avatar' => 'image|mimes:jpeg,jpg,png,webp|max:2048'
            ]);
            
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $validated['avatar'] = $this->avatar->store('avatars', 'public');
            $this->existingAvatar = $validated['avatar'];
            $this->reset('avatar');
        }

        $user->update($validated);

        session()->flash('message', 'Profile updated successfully.');
        return redirect()->route('my-account');
    }

    public function sendResetLink()
    {
        try {
            $user = Auth::user();
            
            // Generate 6 digit OTP
            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            
            // Delete old OTP for this email
            \DB::table('password_reset_otps')->where('email', $user->email)->delete();
            
            // Store OTP in database
            \DB::table('password_reset_otps')->insert([
                'email' => $user->email,
                'otp' => $otp,
                'expires_at' => now()->addMinutes(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            // Send OTP via email
            \Mail::to($user->email)->send(new \App\Mail\ResetPasswordOtpMail($otp, $user->name));
            
            session()->flash('password_message', 'An OTP has been sent to your email (' . $user->email . '). Please check your inbox.');
            
            // Redirect to OTP verification page
            return redirect()->route('verify-reset-otp');
        } catch (\Exception $e) {
            session()->flash('password_error', 'Failed to send OTP: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pages.my-account')->layout('components.layouts.app');
    }
}
