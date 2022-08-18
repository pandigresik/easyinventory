<?php

namespace App\Widgets;

use App\Charts\RevenueMonthlyChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Arrilot\Widgets\AbstractWidget;

class RevenueWidget extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $chart = new RevenueMonthlyChart(new LarapexChart());

        return view('widgets.revenue_widget', [
            'config' => $this->config,
            'chart' => $chart->build(),
        ]);
    }

    public function placeholder()
    {
        return 'Loading...';
    }
}
