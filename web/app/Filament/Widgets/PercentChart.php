<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class PercentChart extends ChartWidget
{
    protected ?string $heading = 'Persentase Polling';
    
    public $record; // diterima dari Page

    protected ?string $placeholderHeight = '300px';
    protected ?string $maxHeight = '300px';

    protected function getType(): string
    {
        return 'pie';
    }

    protected function getData(): array
    {
        if (!$this->record) {
            return [
                'labels' => [],
                'datasets' => [],
            ];
        }

        $labels = $this->record->options->pluck('text');
        $data = $this->record->options->map(fn($o) => $o->votes()->count());
        $totalVotes = $data->sum();

        $percentages = $data->map(fn($count) => $totalVotes > 0 ? round(($count / $totalVotes) * 100, 1) : 0);

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Persentase Polling (%)',
                    'data' => $percentages,
                    'backgroundColor' => [
                        '#3b82f6', // biru
                        '#10b981', // hijau
                        '#f59e0b', // kuning
                        '#ef4444', // merah
                        '#8b5cf6', // ungu
                        '#ec4899', // pink
                        '#0ea5e9', // cyan
                        '#f97316', // orange
                    ],
                ],
            ],
        ];
    }
}
