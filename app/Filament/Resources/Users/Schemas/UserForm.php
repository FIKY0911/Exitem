<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\FileUpload::make('avatar')
                    ->label('Profile Photo')
                    ->image()
                    ->disk('public')
                    ->directory('avatars')
                    ->columnSpanFull(),
                    
                \Filament\Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                    
                \Filament\Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                \Filament\Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(20),
                    
                \Filament\Forms\Components\Select::make('role')
                    ->options([
                        'customer' => 'Customer',
                        'admin' => 'Admin',
                    ])
                    ->default('customer')
                    ->required(),
                    
                \Filament\Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(fn (string $context): bool => $context === 'create')
                    ->dehydrated(fn (?string $state): bool => filled($state))
                    ->dehydrateStateUsing(fn (string $state): string => bcrypt($state)),

                \Filament\Forms\Components\TextInput::make('password_token')
                    ->label('Password Token')
                    ->disabled()
                    ->dehydrated(false),
            ]);
    }
}
