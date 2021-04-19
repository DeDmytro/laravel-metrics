<?php

namespace DeDmytro\Metrics\Entities;

use DateTimeInterface;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use phpDocumentor\Reflection\DocBlock\Tags\Deprecated;

class MetricCacheRecord implements Arrayable
{
    /**
     * User IP address
     * @var string|null
     */
    public ?string $ip;

    /**
     * UTC timestamp
     * @var int
     */
    public int $timestamp;

    /**
     * MetricCacheRecord constructor.
     * @param $ip
     * @param $timestamp
     */
    public function __construct($ip, $timestamp)
    {
        $this->ip = $ip;
        $this->timestamp = $timestamp;
    }

    /**
     * Static constructor from array
     * @param array $data
     * @return MetricCacheRecord
     */
    public static function fromArray(array $data)
    {
        return new self((string) Arr::get($data, 'ip'), (int) Arr::get($data, 'timestamp'));
    }

    /**
     * Static constructor from Request
     * @param Request $request
     * @return MetricCacheRecord
     */
    public static function fromRequest(Request $request)
    {
        return new self((string) $request->ip(), time());
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
          'ip'=> $this->ip,
          'timestamp'=> $this->timestamp,
        ];
    }
}