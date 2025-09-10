<?php

namespace App\Filament\Widgets;

use App\Models\Poll;
use Filament\Widgets\ChartWidget;

class ResultChart extends ChartWidget
{
    protected ?string $heading = 'Hasil Polling';

    public $record; // poll record yang dikirim dari Page

    protected ?string $placeholderHeight = '300px';
    protected ?string $maxHeight = '300px';

    protected function getType(): string
    {
        return 'bar';
    }

    public function getColumns(): int{
        return 4;
    }

    protected function getData(): array
    {
        if (! $this->record) {
            return [
                'labels' => [],
                'datasets' => [],
            ];
        }

        $labels = $this->record->options->pluck('text')->toArray();
        $data = $this->record->options->map(fn($o) => $o->votes()->count())->toArray();

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Jumlah Suara',
                    'data' => $data,
                    'backgroundColor' => array_map(
                        fn($i) => ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'][$i % 5],
                        array_keys($data)
                    ),
                ],
            ],
        ];
    }
}
