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
    
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

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
    }

    public function updateProfile()
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|max:2048', // max 2MB
        ]);

        if ($this->avatar) {
            // Hapus avatar lama jika ada
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            // Simpan yang baru
            $validated['avatar'] = $this->avatar->store('avatars', 'public');
            $this->existingAvatar = $validated['avatar']; // Update preview
            $this->avatar = null; // Clear the temporary upload
        } else {
            unset($validated['avatar']);
        }

        $user->update($validated);

        session()->flash('message', 'Profile updated successfully.');
    }

    public function updatePassword()
    {
        $user = Auth::user();

        $this->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);

        session()->flash('password_message', 'Password updated successfully.');
    }

    public function render()
    {
        return view('livewire.pages.my-account')->layout('components.layouts.app');
    }
}
