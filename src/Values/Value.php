<?php

namespace DeDmytro\Metrics\Values;

class Value extends Base
{
    /**
     * WidgetValue constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Static constructor for widget value
     * @param $value
     * @return Value
     */
    public static function make($value){
        return new static($value);
    }
}
