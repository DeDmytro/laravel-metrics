<?php

namespace DeDmytro\Metrics\Http\Controllers;

use DeDmytro\Metrics\Services\MetricsCacheManager;
use Illuminate\Contracts\View\View;

class HomeController
{
    /**
     * Return
     * @param MetricsCacheManager $metrics
     * @return View
     */
    public function index(MetricsCacheManager $metrics)
    {
        return view('metrics::home');
    }
}
