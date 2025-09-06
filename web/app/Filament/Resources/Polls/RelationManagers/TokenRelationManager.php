<?php

namespace App\Filament\Resources\Polls\RelationManagers;

use Filament\Tables;
use App\Models\Token;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\ExportAction;
use Filament\Resources\RelationManagers\RelationManager;

class TokenRelationManager extends RelationManager
{
    protected static string $relationship = 'tokens';
    protected static ?string $title = 'Daftar Token';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomor')
                    ->label('No')
                    ->rowIndex()
                    ->alignCenter()
                    ->width('50px')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('token')
                    ->label('Token')
                    ->copyable()
                    ->copyMessage('Token disalin!')
                    ->searchable(),

                IconColumn::make('used_at')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->tooltip(fn ($record) => $record->used_at ? 'Sudah digunakan' : 'Belum digunakan'),

                TextColumn::make('used_at')
                    ->label('Dipakai Pada')
                    ->dateTime('d M Y H:i')
                    ->placeholder('-')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->headerActions([
                Action::make('generateTokens')
                ->label('Generate Token')
                ->icon('heroicon-o-key')
                ->schema([
                    TextInput::make('jumlah')
                        ->numeric()
                        ->minValue(1)
                        ->label('Jumlah Token')
                        ->required(),
                ])
                ->action(function (array $data) {
                    $poll = $this->getOwnerRecord();
                    $jumlah = $data['jumlah'];

                    for ($i = 0; $i < $jumlah; $i++) {
                        Token::create([
                            'poll_id' => $poll->id,
                            'token'   => $this->generateUniqueToken(8),
                        ]);
                    }

                    Notification::make()
                        ->title("{$jumlah} token berhasil dibuat!")
                        ->success()
                        ->send();
                }),

                ExportAction::make()->exports([
                    ExcelExport::make('table')->fromTable(),
                ])
            ])
            ->recordActions([
                DeleteAction::make()
                    ->label('Hapus'),
            ])
            ->toolbarActions([
                DeleteBulkAction::make(),
            ]);
    }

    
    protected function generateUniqueToken(int $length = 8): string
    {
        do {
            $token = strtoupper(Str::random($length));
        } while (\App\Models\Token::where('token', $token)->exists());

        return $token;
    }
}
