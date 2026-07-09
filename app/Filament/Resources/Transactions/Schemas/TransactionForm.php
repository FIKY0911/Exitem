<?php

namespace App\Filament\Resources\Transactions\Schemas;

use App\Models\Product;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([

                    Step::make('Product and Price')
                        ->schema([

                            Grid::make(2)
                                ->schema([
                                    Select::make('product_id')
                                        ->relationship('product', 'name')
                                        ->searchable()
                                        ->preload()
                                        ->live()
                                        ->afterStateUpdated(function ($state, callable $get, callable $set) {

                                            $product = Product::find($state);
                                            $price = $product ? $product->price : 0;
                                            $quantity = $get('quantity') ?? 1;
                                            $subTotalAmount = $price * $quantity;

                                            $set('price', $price);
                                            $set('sub_total_amount', $subTotalAmount);

                                            $grandTotalAmount = $subTotalAmount; // Assuming no additional fees or discounts for simplicity
                                            $set('grand_total_amount', $grandTotalAmount);
                                        }),

                                    TextInput::make('quantity')
                                        ->numeric()
                                        ->required()
                                        ->prefix('Qty: ')
                                        ->default(1)
                                        ->live()
                                        ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                            $price = $get('price') ?? 0;
                                            $quantity = $state;
                                            $subTotalAmount = $price * $quantity;
                                            $set('sub_total_amount', $subTotalAmount);

                                            $grandTotalAmount = $subTotalAmount; // Assuming no additional fees or discounts for simplicity
                                            $set('grand_total_amount', $grandTotalAmount);
                                        }),

                                    TextInput::make('sub_total_amount')
                                        ->required()
                                        ->readOnly()
                                        ->numeric()
                                        ->prefix('IDR'),

                                    TextInput::make('grand_total_amount')
                                        ->required()
                                        ->readOnly()
                                        ->numeric()
                                        ->prefix('IDR'),
                                ]),
                        ]),

                    Step::make('Customer Information')
                        ->schema([
                            Select::make('user_id')
                                ->label('User Account')
                                ->relationship('user', 'name')
                                ->searchable()
                                ->preload()
                                ->helperText('Connect this transaction to a registered user account.'),

                            TextInput::make('name')
                                ->label('Billing Name')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('phone')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('email')
                                ->required()
                                ->email()
                                ->maxLength(255),

                            TextInput::make('address')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('city')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('post_code')
                                ->required()
                                ->maxLength(255),

                        ]),

                    Step::make('Payment Information')
                        ->schema([
                            TextInput::make('booking_trx_id')
                                ->required()
                                ->maxLength(255),

                            ToggleButtons::make('is_paid')
                                ->label('Payment Status')
                                ->boolean()
                                ->grouped()
                                ->icons([
                                    'heroicon-o-x-mark' => false,
                                    'heroicon-o-check' => true,
                                ])
                                ->required(),

                            FileUpload::make('proof')
                                ->image()
                                ->nullable()
                                ->dehydrated(fn ($state) => filled($state)),
                        ]),

                    Step::make('Midtrans Billing (Detail Data)')
                        ->schema([
                            Placeholder::make('midtrans_status')
                                ->label('Midtrans Payment Status')
                                ->content(fn ($record) => $record?->midtransPayment?->status ?? 'Belum ada data pembayaran Midtrans'),

                            Placeholder::make('midtrans_payment_type')
                                ->label('Payment Method')
                                ->content(fn ($record) => $record?->midtransPayment?->payment_type ?? '-'),

                            Placeholder::make('midtrans_amount')
                                ->label('Amount Paid')
                                ->content(fn ($record) => $record?->midtransPayment?->amount ? 'IDR '.number_format($record->midtransPayment->amount, 0, ',', '.') : '-'),

                            Placeholder::make('midtrans_transaction_id')
                                ->label('Midtrans Transaction ID')
                                ->content(fn ($record) => $record?->midtransPayment?->transaction_id ?? '-'),

                            Placeholder::make('midtrans_payment_url')
                                ->label('Payment URL')
                                ->content(function ($record) {
                                    if ($record && $record->midtransPayment && $record->midtransPayment->redirect_url) {
                                        return new HtmlString('<a href="'.$record->midtransPayment->redirect_url.'" target="_blank" class="text-primary-600 underline">Link Pembayaran</a>');
                                    }

                                    return '-';
                                }),
                        ])
                        ->visible(fn ($record) => $record !== null),
                ])
                    ->columns(1)
                    ->columnSpanFull()
                    ->skippable(),
            ]);
    }
}
