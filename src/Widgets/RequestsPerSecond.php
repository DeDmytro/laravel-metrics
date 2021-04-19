<?php

namespace DeDmytro\Metrics\Widgets;

use DeDmytro\Metrics\Services\MetricsCacheManager;
use DeDmytro\Metrics\Types\ValueWidget;
use DeDmytro\Metrics\Values\Value;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class RequestsPerSecond implements ValueWidget
{
    /**
     * {@inheritDoc}
     */
    public function title(): string
    {
        return 'Request per second';
    }

    /**
     * {@inheritDoc}
     */
    public function value(): Value
    {
        $manager = new MetricsCacheManager();
        $value = $manager->getRecordsForLastSeconds(5)->count();

        return Value::make($value)->double(1);
    }
}