<?php

namespace DeDmytro\Metrics\Values;

abstract class Base
{
    /**
     * Contains value that should be displayed
     * @var mixed
     */
    protected $value;

    /**
     * Return integer representation of value
     * @return static
     */
    final public function integer(): Base
    {
        $this->value = (int) $this->value;
        return $this;
    }

    /**
     * Return integer representation of value
     * @param int $precision
     * @return static
     */
    public function double($precision = 2): Value
    {
        $this->value = round((float) $this->value, $precision);
        return $this;
    }

    /**
     * Return money representation
     * @param null|string $currency
     * @return static
     */
    public function money($currency = null): string
    {
        $this->double();
        $value = number_format($this->value, 2, '.', ',');
        return $currency ? "$currency $value" : $currency;
    }

    /**
     * Return current value
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Return string repsentation of value
     * @return string
     */
    public function __toString()
    {
        return (string) $this->value;
    }
}