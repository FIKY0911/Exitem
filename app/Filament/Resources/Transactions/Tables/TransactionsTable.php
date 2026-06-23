<?php

namespace App\Filament\Resources\Transactions\Tables;

use App\Models\Transaction;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class TransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->poll('5s')
            ->columns([
                ImageColumn::make('product.thumbnail')
                    ->label('Thumbnail'),

                TextColumn::make('booking_trx_id')
                    ->label('Trx ID')
                    ->searchable(),

                TextColumn::make('user.name')
                    ->label('Account Holder')
                    ->description(fn (Transaction $record): string => $record->user?->email ?? 'Guest')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Billing Name')
                    ->description(fn (Transaction $record): string => "Phone: {$record->phone}")
                    ->searchable(),

                TextColumn::make('grand_total_amount')
                    ->label('Total')
                    ->money('IDR')
                    ->sortable(),

                IconColumn::make('is_paid')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->label('Status'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),

                SelectFilter::make('product_id')
                    ->label('Product')
                    ->relationship('product', 'name'),

                SelectFilter::make('user_id')
                    ->label('Customer Account')
                    ->relationship('user', 'name'),
            ])
            ->recordActions([
                EditAction::make(),
                ViewAction::make(),

                Action::make('approve')
                    ->label('Approve')
                    ->action(function (Transaction $record) {
                        $record->is_paid = true;
                        $record->save();

                        Notification::make()
                            ->title('Transaction Approved')
                            ->body('The transaction has been approved successfully.')
                            ->success()
                            ->send();
                    })
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (Transaction $record) => ! $record->is_paid),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
