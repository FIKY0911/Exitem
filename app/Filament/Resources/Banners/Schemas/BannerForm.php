<?php

namespace App\Filament\Resources\Banners\Schemas;

use App\Models\Product;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('subtitle')
                    ->required()
                    ->placeholder('e.g. iPhone 14 Series')
                    ->maxLength(255),

                TextInput::make('title')
                    ->required()
                    ->placeholder('e.g. Up to 10% off Voucher')
                    ->maxLength(255),

                TextInput::make('cta_label')
                    ->label('Button Label')
                    ->default('Shop Now')
                    ->required(),

                Select::make('cta_url')
                    ->label('Link to Product')
                    ->options(Product::pluck('name', 'slug')->toArray())
                    ->searchable()
                    ->getSearchResultsUsing(fn (string $search) =>
                        Product::where('name', 'like', "%{$search}%")
                            ->pluck('name', 'slug')
                            ->toArray()
                    )
                    ->nullable(),

                TextInput::make('order')
                    ->numeric()
                    ->default(0)
                    ->label('Display Order'),

                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true),

                FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->required()
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }
}
