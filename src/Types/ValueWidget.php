<?php

namespace DeDmytro\Metrics\Types;

use DeDmytro\Metrics\Values\Value;

interface ValueWidget extends BaseWidget
{
    /**
     * Return widget value
     * @return Value
     */
    public function value() : Value;
}