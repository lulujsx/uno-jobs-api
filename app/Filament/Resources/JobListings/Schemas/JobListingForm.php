<?php

namespace App\Filament\Resources\JobListings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class JobListingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('company'),
                TextInput::make('seniority'),
                TextInput::make('modality'),
                TextInput::make('location'),
                Textarea::make('technologies')
                    ->columnSpanFull(),
                Textarea::make('external_url')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('status')
                    ->required()
                    ->default('pending'),
            ]);
    }
}
