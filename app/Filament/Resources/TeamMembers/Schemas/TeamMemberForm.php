<?php

namespace App\Filament\Resources\TeamMembers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TeamMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            FileUpload::make('photo')
                ->label('Photo')
                ->image()
                ->disk('public')
                ->directory('team')
                ->imageEditor()
                ->circleCropper()
                ->columnSpanFull(),

            TextInput::make('name')
                ->required()
                ->maxLength(255),

            TextInput::make('role')
                ->required()
                ->maxLength(255),

            TextInput::make('order')
                ->numeric()
                ->default(0)
                ->label('Display Order'),
        ])->columns(2);
    }
}
