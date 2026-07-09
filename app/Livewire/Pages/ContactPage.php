<?php

namespace App\Livewire\Pages;

use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

class ContactPage extends Component
{
    public string $name    = '';
    public string $email   = '';
    public string $phone   = '';
    public string $message = '';
    public bool   $sending = false;

    protected function rules(): array
    {
        return [
            'name'    => 'required|string|min:2',
            'email'   => 'required|email',
            'phone'   => 'nullable|regex:/^[0-9+\-\s]+$/',
            'message' => 'required|string|min:10',
        ];
    }

    public function send(): void
    {
        $this->validate();

        $key = 'contact:' . request()->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $this->addError('message', 'Too many messages. Please wait a moment.');
            return;
        }

        RateLimiter::hit($key, 60);

        \App\Models\ContactMessage::create([
            'name'    => strip_tags($this->name),
            'email'   => strip_tags($this->email),
            'phone'   => $this->phone ? strip_tags($this->phone) : null,
            'message' => strip_tags($this->message),
        ]);

        $this->reset(['name', 'email', 'phone', 'message']);
        session()->flash('success', 'Your message has been sent! We\'ll get back to you soon.');
    }

    public function render()
    {
        return view('livewire.pages.contact')
            ->layout('components.layouts.app');
    }
}
