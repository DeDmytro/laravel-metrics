<?php

namespace DeDmytro\Metrics\Widgets;

use DeDmytro\Metrics\Types\MultipleValueWidget;
use DeDmytro\Metrics\Types\ValueWidget;
use DeDmytro\Metrics\Values\LabeledValue;
use DeDmytro\Metrics\Values\Value;
use Illuminate\Database\Events\StatementPrepared;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use PDO;

class MysqlConnections implements MultipleValueWidget
{

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return 'MySQL';
    }

    /**
     * @inheritDoc
     */
    public function values(): array
    {
        $values = [];

        Event::listen(StatementPrepared::class, function ($event) {
            $event->statement->setFetchMode(PDO::FETCH_ASSOC);
        });

        $result = DB::select(DB::raw("
                SHOW STATUS
                WHERE Variable_name = 'Max_used_connections'
                OR Variable_name = 'Threads_connected'
       "));

        $maxConnections = DB::select(DB::raw("SHOW VARIABLES LIKE 'max_connections'"));

        if (!empty($maxConnections)) {
            $result[] = $maxConnections[0];
        }

        foreach ($result as $record) {
            if (Arr::has($record, ['Variable_name', 'Value'])) {
                $label = __('metrics::widgets.'.$record['Variable_name']);
                $values[] = new LabeledValue($label, (int) $record['Value']);
            }
        }

        return $values;
    }
}