<?php

namespace App\Filament\Resources\Polls\Pages;

use App\Filament\Resources\Polls\PollResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class PollResults extends Page
{
    use InteractsWithRecord;

    protected static string $resource = PollResource::class;

    protected string $view = 'volt-livewire::filament.resources.polls.pages.poll-results';

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }
}
