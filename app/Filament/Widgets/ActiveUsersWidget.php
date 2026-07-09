<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ActiveUsersWidget extends BaseWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';
    protected ?string $pollingInterval = '10s';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                User::query()
                    ->join('sessions', 'users.id', '=', 'sessions.user_id')
                    ->select('users.id', 'users.name', 'users.email', 'users.role', 'sessions.ip_address', 'sessions.user_agent', 'sessions.last_activity')
                    ->whereNotNull('sessions.user_id')
                    ->orderBy('sessions.last_activity', 'desc')
            )
            ->heading('Active E-commerce Users (Live)')
            ->description('Users who are currently logged in to the client side.')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('User Name')
                    ->searchable()
                    ->sortable()
                    ->description(fn (User $record): string => $record->email),
                Tables\Columns\TextColumn::make('role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'danger',
                        'user' => 'success',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('ip_address')
                    ->label('IP Address')
                    ->fontFamily('mono')
                    ->icon('heroicon-m-computer-desktop'),
                Tables\Columns\TextColumn::make('user_agent')
                    ->label('Browser / Device')
                    ->limit(40)
                    ->tooltip(fn (User $record): string => $record->user_agent ?? ''),
                Tables\Columns\TextColumn::make('last_activity')
                    ->label('Last Active')
                    ->formatStateUsing(fn ($state) => \Carbon\Carbon::createFromTimestamp($state)->diffForHumans())
                    ->badge()
                    ->color('primary'),
            ])
            ->paginated([5, 10, 25])
            ->defaultPaginationPageOption(5);
    }
}
