<?php

namespace App\Filament\Resources\JobListings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Tables\Filters\SelectFilter;
use App\Models\JobListing;

class JobListingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('company')
                    ->searchable(),
                TextColumn::make('seniority')
                    ->searchable(),
                TextColumn::make('modality')
                    ->searchable(),
                TextColumn::make('location')
                    ->searchable(),
                TextColumn::make('status')
                    ->searchable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'published' => 'success',
                        'rejected' => 'danger',
                        default => 'gray'
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pendiente',
                        'published' => 'Publicada',
                        'rejected' => 'Rechazada',
                        default => $state,
                    }),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Estado')
                    ->options([
                        'pending' => 'Pendiente',
                        'published' => 'Publicada',
                        'rejected' => 'Rechazada',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('approve')
                    ->label('Aprobar')
                    ->requiresConfirmation()
                    ->action(function (JobListing $record) {
                        $record->status = 'published';
                        $record->save();
                        Notification::make()
                            ->title('Oferta publicada')
                            ->success()
                            ->send();
                    })
                    ->visible(fn (JobListing $record): bool => $record->status === 'pending'),
                    Action::make('reject')
                    ->label('Rechazar')
                    ->requiresConfirmation()
                    ->action(function (JobListing $record) {
                        $record->status = 'rejected';
                        $record->save();
                        Notification::make()
                            ->title('Oferta rechazada')
                            ->success()
                            ->send();
                    })
                    ->visible(fn (JobListing $record): bool => $record->status === 'pending'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
