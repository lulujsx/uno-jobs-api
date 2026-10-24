<?php

namespace App\Filament\Resources\JobListings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;

class JobListingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('company'),
                Select::make('seniority')
                    ->options([
                        'trainee' => 'Trainee',
                        'junior' => 'Junior',
                        'semi-senior' => 'Semi-Senior',
                        'senior' => 'Senior',
                    ]),
                Select::make('modality')
                    ->options([
                        'remote' => 'Remoto',
                        'hybrid' => 'Híbrido',
                        'on-site' => 'Presencial',
                    ]),
                TextInput::make('location'),
                Select::make('technologies')
                    ->multiple()
                    ->options([
                        'React' => 'React',
                        'TypeScript' => 'TypeScript',
                        'Flutter' => 'Flutter',
                    ])
                    ->columnSpanFull(),
                Textarea::make('external_url')
                    ->required()
                    ->columnSpanFull(),
                Select::make('status')
                    ->options([
                        'pending' => 'Pendiente',
                        'published' => 'Publicada',
                        'rejected' => 'Rechazada',
                    ])
                    ->default('pending')
                    ->required(),
                Textarea::make('description')
                    ->label('Descripción')
                    ->columnSpanFull(),
            ]);
    }
}
