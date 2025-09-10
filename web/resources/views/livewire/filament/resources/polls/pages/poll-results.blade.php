<x-filament-panels::page>
    <div class="space-y-8">

        {{-- Judul Poll --}}
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 mb-2">
                📊 Hasil Polling
            </h2>
            <p class="text-gray-600 dark:text-gray-400">{{ $record->title }}</p>
        </div>

        {{-- Grid Chart + Detail --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            {{-- Chart --}}
            <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-md flex items-center justify-center">
                <div id="poll-chart" class="w-full min-h-[400px]"></div>
            </div>

            {{-- Detail Votes --}}
            <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-md">
                <h3 class="text-xl font-semibold mb-6 text-gray-800 dark:text-gray-200">
                    Detail Suara
                </h3>

                @php
                    $totalVotes = $record->options->sum(fn($o) => $o->votes()->count());
                    $maxVotes = $record->options->max(fn($o) => $o->votes()->count());
                @endphp

                <div class="space-y-6">
                    @foreach($record->options as $option)
                        @php
                            $count = $option->votes()->count();
                            $percent = $totalVotes > 0 ? round(($count / $totalVotes) * 100, 1) : 0;
                            $isWinner = $count === $maxVotes && $count > 0;
                        @endphp

                        <div class="p-4 rounded-xl border transition hover:shadow-md
                            {{ $isWinner 
                                ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/30' 
                                : 'border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800' }}">
                            
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center space-x-3">
                                    {{-- Avatar inisial --}}
                                    <div class="w-10 h-10 flex items-center justify-center rounded-full 
                                        {{ $isWinner ? 'bg-blue-500 text-white' : 'bg-gray-300 text-gray-700 dark:bg-gray-600 dark:text-gray-200' }}">
                                        {{ strtoupper(substr($option->text, 0, 1)) }}
                                    </div>
                                    <span class="font-medium text-gray-800 dark:text-gray-200">
                                        {{ $option->text }}
                                        @if($isWinner)
                                            <span class="ml-2 text-sm px-2 py-0.5 rounded-full bg-blue-600 text-white">🏆 Teratas</span>
                                        @endif
                                    </span>
                                </div>
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">
                                    {{ $count }} suara ({{ $percent }}%)
                                </span>
                            </div>

                            {{-- Progress Bar --}}
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3 overflow-hidden">
                                <div class="h-3 rounded-full transition-all duration-700 ease-out
                                    {{ $isWinner ? 'bg-blue-600' : 'bg-gray-400 dark:bg-gray-500' }}"
                                    style="width: {{ $percent }}%">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @php
        $labels = $record->options->pluck('text');
        $data = $record->options->map(fn($o) => $o->votes()->count());
    @endphp

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var options = {
                    chart: {
                        type: 'bar',
                        height: 400,
                        toolbar: { show: false },
                    },
                    series: [{
                        name: 'Suara',
                        data: @json($data)
                    }],
                    xaxis: {
                        categories: @json($labels),
                        labels: { style: { colors: '#6b7280' } }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: true,
                            borderRadius: 8,
                            distributed: true,
                        }
                    },
                    colors: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'],
                    dataLabels: {
                        enabled: true,
                        style: { colors: ['#fff'] },
                        formatter: function (val) {
                            return val + " suara";
                        }
                    },
                    grid: {
                        borderColor: '#e5e7eb',
                        xaxis: { lines: { show: false } },
                        yaxis: { lines: { show: false } },
                    },
                    legend: { show: false }
                };

                var chart = new ApexCharts(document.querySelector("#poll-chart"), options);
                chart.render();
            });
        </script>
    @endpush
</x-filament-panels::page>
