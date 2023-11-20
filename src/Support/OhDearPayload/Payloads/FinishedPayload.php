<?php

namespace logvieweradarsh\ScheduleMonitor\Support\OhDearPayload\Payloads;

use Illuminate\Support\Arr;
use logvieweradarsh\ScheduleMonitor\Models\MonitoredScheduledTaskLogItem;

class FinishedPayload extends Payload
{
    public static function canHandle(MonitoredScheduledTaskLogItem $logItem): bool
    {
        return $logItem->type === MonitoredScheduledTaskLogItem::TYPE_FINISHED;
    }

    public function url()
    {
        return "{$this->baseUrl()}/finished";
    }

    public function data(): array
    {
        return Arr::only($this->logItem->meta ?? [], [
            'runtime',
            'exit_code',
            'memory',
        ]);
    }
}
