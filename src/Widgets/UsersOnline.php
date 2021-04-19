<?php

namespace DeDmytro\Metrics\Widgets;

use DeDmytro\Metrics\Services\MetricsCacheManager;
use DeDmytro\Metrics\Types\ValueWidget;
use DeDmytro\Metrics\Values\Value;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class UsersOnline implements ValueWidget
{
    /**
     * {@inheritDoc}
     */
    public function title(): string
    {
        return 'Users Online';
    }

    /**
     * {@inheritDoc}
     */
    public function value(): Value
    {
        $manager = new MetricsCacheManager();
        $value = $manager->getRecordsForLastSeconds(300)->unique('ip')->count();

        return Value::make($value)->integer();
    }
}