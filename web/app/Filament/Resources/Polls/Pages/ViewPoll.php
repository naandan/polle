<?php

namespace App\Filament\Resources\Polls\Pages;

use App\Models\Token;
use Illuminate\Support\Str;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\Polls\PollResource;
use Filament\Infolists\Components\RepeatableEntry;

class ViewPoll extends ViewRecord
{
    protected static string $resource = PollResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
        ];
    }
}
