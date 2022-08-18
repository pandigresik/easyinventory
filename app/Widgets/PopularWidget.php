<?php

namespace App\Widgets;

use App\Charts\PopularChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Arrilot\Widgets\AbstractWidget;

class PopularWidget extends AbstractWidget
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
        $chart = new PopularChart(new LarapexChart());

        return view('widgets.popular_widget', [
            'config' => $this->config,
            'chart' => $chart->build(),
        ]);
    }
}
