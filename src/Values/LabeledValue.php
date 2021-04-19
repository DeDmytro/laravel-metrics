<?php

namespace DeDmytro\Metrics\Values;

class LabeledValue extends Base
{
    /**
     * Contains label of value
     * @var string
     */
    protected $label;

    /**
     * LabeledValue constructor.
     * @param string $label
     * @param mixed $value
     */
    public function __construct(string $label, $value)
    {
        $this->label = $label;
        $this->value = $value;
    }

    /**
     * Return label
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }
}
