<?php

namespace App\Filament\Resources\Polls\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;

class PollInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title')
                    ->label('Judul'),

                TextEntry::make('description')
                    ->label('Deskripsi')
                    ->default('-'),

                TextEntry::make('start_at')
                    ->label('Mulai')
                    ->dateTime('d M Y H:i'),

                TextEntry::make('end_at')
                    ->label('Selesai')
                    ->dateTime('d M Y H:i'),

                IconEntry::make('multiple_choice')
                    ->label('Boleh Pilih Lebih dari Satu')
                    ->boolean(),

                TextEntry::make('created_at')
                    ->label('Dibuat pada')
                    ->dateTime('d M Y H:i'),

                RepeatableEntry::make('options')
                    ->label('Opsi Voting')
                    ->schema([
                        TextEntry::make('text')
                            ->label('Opsi'),
                        TextEntry::make('votes_count')
                            ->label('Jumlah Suara'),
                    ])
                    ->columns(2),
            ]);
    }
}
