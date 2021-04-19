<?php

namespace DeDmytro\Metrics\Services;

use DeDmytro\Metrics\Types\BaseWidget;
use Illuminate\Support\Collection;

class MetricWidget
{
    /**
     * Return widgets
     * @return Collection|BaseWidget[]
     */
    public static function all()
    {
        return collect(config('metrics.widgets'))->map(fn($class) => new $class)->whereInstanceOf(BaseWidget::class);
    }
}