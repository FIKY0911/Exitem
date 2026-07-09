<?php

namespace App\Filament\Resources\TeamMembers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TeamMembersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order')->sortable()->label('#'),
                ImageColumn::make('photo')
                    ->disk('public')
                    ->circular()
                    ->defaultImageUrl(fn ($record) =>
                        'https://ui-avatars.com/api/?name='.urlencode($record->name).'&background=DB4444&color=fff'
                    ),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('role')->searchable(),
            ])
            ->defaultSort('order')
            ->reorderable('order')
            ->recordActions([EditAction::make()])
            ->toolbarActions([
                CreateAction::make(),
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
