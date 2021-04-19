<?php

namespace DeDmytro\Metrics\Services;

use Closure;
use DeDmytro\Metrics\Entities\MetricCacheRecord;
use Exception;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Psr\SimpleCache\InvalidArgumentException;

final class MetricsCacheManager
{
    /**
     * Cache repository
     * @var Repository
     */
    private Repository $cache;

    /**
     * Cache lifetime in seconds
     * @var int
     */
    private int $cacheExpired;

    /**
     * Cache key
     * @var string
     */
    private string $cacheKey;

    /**
     * MetricsCacheManager constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->cache = cache()->driver(config('metrics.cache_driver'));
        $this->cacheExpired = (int) config('metrics.cache_expired');
        $this->cacheKey = (int) config('metrics.cache_key');
    }

    /**
     * Init cache manager and put new record to cache
     * @throws InvalidArgumentException
     */
    public static function init()
    {
        $manager = new self();
        $manager->putRecord(MetricCacheRecord::fromRequest(request()));
        $manager->registerShutdownCallback();
    }

    /**
     * Return records for last amount of seconds
     * @param int|null $seconds
     * @return Collection
     * @throws InvalidArgumentException
     */
    public function getRecordsForLastSeconds(int $seconds = null)
    {
        $seconds = $seconds ?: $this->cacheExpired;
        $startTime = time() - $seconds;

        return $this->getRecordsWhere(fn(MetricCacheRecord $record) => $record->timestamp >= $startTime);
    }

    /**
     * Return cache records which match condition
     * @param Closure $where
     * @return Collection
     * @throws InvalidArgumentException
     */
    public function getRecordsWhere(Closure $where): Collection
    {
        return collect($this->getRecords())
            ->map(fn($record) => MetricCacheRecord::fromArray((array) $record))
            ->filter($where);
    }

    /**
     * Return all records
     * @return array
     * @throws InvalidArgumentException
     */
    private function getRecords(): array
    {
        return Arr::wrap($this->cache->get($this->cacheKey));
    }

    /**
     * Put new record to cache
     * @param MetricCacheRecord $cacheRecord
     * @throws InvalidArgumentException
     */
    public function putRecord(MetricCacheRecord $cacheRecord)
    {
        $records = $this->getRecords();

        $records[] = $cacheRecord->toArray();

        $this->cache->put($this->cacheKey, $records, $this->cacheExpired);
    }

    /**
     * Replace cached records with valied records
     * @return void
     * @throws InvalidArgumentException
     */
    public function clearExpiredRecords()
    {
        $this->cache->put($this->cacheKey, $this->getRecordsForLastSeconds($this->cacheExpired), $this->cacheExpired);
    }

    /**
     * Clear all records
     * @return void
     * @throws InvalidArgumentException
     */
    public function clearAllRecords()
    {
        $this->cache->put($this->cacheKey, [], $this->cacheExpired);
    }

    /**
     * Register function to clear expired records
     * @return void
     * @throws InvalidArgumentException
     */
    private function registerShutdownCallback()
    {
        $chance = random_int(0, 99); // Dummy way to define small chance

        if ($chance <= 2) {
            register_shutdown_function(function () {
                $this->clearExpiredRecords();
            });
        }
    }
}