<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),

                Select::make('icon')
                    ->label('Icon')
                    ->required()
                    ->searchable()
                    ->options([
                        'heroicon-o-computer-desktop'    => '🖥️  Desktop / Computer',
                        'heroicon-o-camera'              => '📷  Camera',
                        'heroicon-o-device-phone-mobile' => '📱  Phone',
                        'heroicon-o-puzzle-piece'        => '🎮  Gaming',
                        'heroicon-o-device-tablet'       => '💻  Laptop',
                        'heroicon-o-viewfinder-circle'   => '📟  Tablet',
                        'heroicon-o-clock'               => '⌚  Smartwatch',
                        'heroicon-o-musical-note'        => '🎧  Headphone / Audio',
                        'heroicon-o-tv'                  => '📺  Television',
                        'heroicon-o-cube'                => '📦  Other',
                    ]),
            ]);
    }
}
