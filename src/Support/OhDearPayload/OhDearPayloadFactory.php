<?php

namespace logvieweradarsh\ScheduleMonitor\Support\OhDearPayload;

use logvieweradarsh\ScheduleMonitor\Models\MonitoredScheduledTaskLogItem;
use logvieweradarsh\ScheduleMonitor\Support\OhDearPayload\Payloads\FailedPayload;
use logvieweradarsh\ScheduleMonitor\Support\OhDearPayload\Payloads\FinishedPayload;
use logvieweradarsh\ScheduleMonitor\Support\OhDearPayload\Payloads\Payload;

class OhDearPayloadFactory
{
    public static function createForLogItem(MonitoredScheduledTaskLogItem $logItem): ?Payload
    {
        $payloadClasses = [
            FailedPayload::class,
            FinishedPayload::class,
        ];

        $payloadClass = collect($payloadClasses)
            ->first(fn (string $payloadClass) => $payloadClass::canHandle($logItem));

        if (! $payloadClass) {
            return null;
        }

        return new $payloadClass($logItem);
    }
}
