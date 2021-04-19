<?php

namespace DeDmytro\Metrics\Http\Controllers;

use DeDmytro\Metrics\Services\MetricsCacheManager;

class HomeController
{
    /**
     * Return
     * @param MetricsCacheManager $metrics
     * @return \Illuminate\Contracts\View\View
     */
    public function index(MetricsCacheManager $metrics)
    {
        return view('metrics::home');
    }
}
