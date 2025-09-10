<?php

namespace App\Livewire;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    public $record; // langsung diterima dari Page

    protected function getStats(): array
    {
        if (!$this->record) {
            return [];
        }

        $totalVotes = $this->record->options->sum(fn($o) => $o->votes()->count());
        $optionCount = $this->record->options->count();
        $maxVotes = $this->record->options->max(fn($o) => $o->votes()->count());
        $topOption = $this->record->options->first(fn($o) => $o->votes()->count() === $maxVotes);

        $totalTokens = $this->record->tokens->count();
        $usedTokens = $this->record->tokens->whereNotNull('used_at')->count();
        $percentUsed = $totalTokens > 0 ? round(($usedTokens / $totalTokens) * 100, 1) : 0;

        return [
            Stat::make('Total Suara', $totalVotes),
            Stat::make('Jumlah Opsi', $optionCount),
            Stat::make('Suara Terbanyak', $maxVotes),
            Stat::make('Pemenang Sementara', $topOption?->text ?? '-'),
            Stat::make('Total Token', $totalTokens),
            Stat::make('Token Digunakan', "{$usedTokens} ({$percentUsed}%)"),
        ];
    }
}
