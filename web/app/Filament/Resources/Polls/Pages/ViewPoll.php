<?php

namespace App\Filament\Resources\Polls\Pages;

use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\Polls\PollResource;

class ViewPoll extends ViewRecord
{
    protected static string $resource = PollResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->icon('heroicon-o-pencil'),
            Action::make('results')
                ->label('Lihat Hasil')
                ->url(fn () => route('filament.admin.resources.polls.results', $this->record))
                ->icon('heroicon-o-chart-bar')
                ->color('primary'),
        ];
    }
}
