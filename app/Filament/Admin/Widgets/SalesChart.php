<?php

namespace App\Filament\Admin\Widgets;

use App\Models\t_penjualan_detail;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class SalesChart extends ChartWidget
{
    protected ?string $heading = 'Sales Trend (Last 30 Days)';
    protected string $color = 'info';

    protected function getData(): array
    {
        $data = DB::table('t_penjualan_detail')
            ->join('t_penjualan', 't_penjualan_detail.penjualan_id', '=', 't_penjualan.penjualan_id')
            ->select(
                DB::raw('DATE(t_penjualan.penjualan_tanggal) as date'),
                DB::raw('SUM(t_penjualan_detail.harga * t_penjualan_detail.jumlah) as total')
            )
            ->where('t_penjualan.penjualan_tanggal', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Daily Revenue',
                    'data' => $data->pluck('total')->toArray(),
                    'fill' => 'start',
                    'tension' => 0.4,
                ],
            ],
            'labels' => $data->map(fn($item) => Carbon::parse($item->date)->format('M d'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
