<?php

namespace DeDmytro\Metrics\Types;

use DeDmytro\Metrics\Values\LabeledValue;
use DeDmytro\Metrics\Values\Value;

interface MultipleValueWidget extends BaseWidget
{
    /**
     * Return widget values
     * @return array|LabeledValue[]
     */
    public function values() : array;
}