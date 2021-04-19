<?php

namespace DeDmytro\Metrics\Services;

use DeDmytro\Metrics\Types\BaseWidget;

class MetricWidget
{
    /**
     * Return widgets
     * @return \Illuminate\Support\Collection|BaseWidget[]
     */
    public static function all()
    {
        return collect(config('metrics.widgets'))->map(fn($class) => new $class)->whereInstanceOf(BaseWidget::class);
    }
}