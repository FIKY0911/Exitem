<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Register as BaseRegister;
use Illuminate\Support\Str;

class AdminRegister extends BaseRegister
{
    protected function mutateFormDataBeforeRegister(array $data): array
    {
        $data['role'] = 'admin';
        
        // Generate password token similar to client signup
        $token = Str::random(16);
        $extraKey = (string) random_int(1000000000, 9999999999);
        $data['password_token'] = $token . $extraKey;

        return $data;
    }
}
