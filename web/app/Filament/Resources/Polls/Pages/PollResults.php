<?php

namespace App\Filament\Resources\Polls\Pages;

use App\Filament\Resources\Polls\PollResource;
use App\Filament\Widgets\PercentChart;
use App\Filament\Widgets\ResultChart;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\UsageChart;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class PollResults extends Page
{
    use InteractsWithRecord;

    protected static string $resource = PollResource::class;

    protected static ?string $title = "Hasil Polling";
    
    protected string $view = 'volt-livewire::filament.resources.polls.pages.poll-results';

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }

    public function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class,
            ResultChart::class,
            PercentChart::class
        ];
    }

}
