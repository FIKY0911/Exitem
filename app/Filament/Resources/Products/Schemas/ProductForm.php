<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make()->tabs([

                    Tab::make('Product Info')
                        ->icon('heroicon-o-information-circle')
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255)
                                ->columnSpanFull(),

                            TextInput::make('price')
                                ->required()
                                ->numeric()
                                ->prefix('IDR'),

                            TextInput::make('stock')
                                ->numeric()
                                ->required()
                                ->prefix('Pcs'),

                            Select::make('category_id')
                                ->preload()
                                ->relationship('category', 'name')
                                ->searchable()
                                ->required(),

                            Select::make('brand_id')
                                ->preload()
                                ->relationship('brand', 'name')
                                ->searchable()
                                ->required(),

                            Select::make('is_popular')
                                ->label('Popular Status')
                                ->options([
                                    false => 'Not Popular',
                                    true  => 'Popular',
                                ])
                                ->required(),

                            Textarea::make('about')
                                ->label('Description')
                                ->required()
                                ->rows(4)
                                ->columnSpanFull(),
                        ])
                        ->columns(2),

                    Tab::make('Media')
                        ->icon('heroicon-o-photo')
                        ->schema([
                            FileUpload::make('thumbnail')
                                ->label('Thumbnail')
                                ->image()
                                ->disk('public')
                                ->required()
                                ->columnSpanFull(),
                        ]),

                    Tab::make('Variants')
                        ->icon('heroicon-o-swatch')
                        ->schema([
                            Repeater::make('colors')
                                ->label('Available Colors')
                                ->schema([
                                    ColorPicker::make('value')
                                        ->label('Color')
                                        ->required(),
                                ])
                                ->addActionLabel('Add Color')
                                ->columnSpanFull(),
                        ]),

                ])->columnSpanFull(),
            ]);
    }
}
