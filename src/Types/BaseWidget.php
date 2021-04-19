<?php

namespace DeDmytro\Metrics\Types;

interface BaseWidget
{
    /**
     * Return widget title string
     * @return string
     */
    public function title(): string;
}