<?php

namespace App\Filament\Resources\Polls\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;

class PollForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label("Judul")
                    ->required(),

                Textarea::make('description')
                    ->columnSpanFull(),

                DateTimePicker::make('start_at')
                    ->label('Mulai'),

                DateTimePicker::make('end_at')
                    ->label('Selesai'),

                Toggle::make('multiple_choice')
                    ->label('Boleh pilih lebih dari satu')
                    ->default(false),

                Repeater::make('options')
                    ->relationship('options')
                    ->label('Daftar Opsi')
                    ->schema([
                        TextInput::make('text')
                            ->label('Opsi')
                            ->required(),
                    ])
                    ->minItems(2) // minimal 2 opsi
                    ->columnSpanFull(),
            ]);
    }
}
