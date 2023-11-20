<?php

namespace logvieweradarsh\ScheduleMonitor\Support\ScheduledTasks;

use Illuminate\Console\Scheduling\Event;
use logvieweradarsh\ScheduleMonitor\Support\ScheduledTasks\Tasks\ClosureTask;
use logvieweradarsh\ScheduleMonitor\Support\ScheduledTasks\Tasks\CommandTask;
use logvieweradarsh\ScheduleMonitor\Support\ScheduledTasks\Tasks\JobTask;
use logvieweradarsh\ScheduleMonitor\Support\ScheduledTasks\Tasks\ShellTask;
use logvieweradarsh\ScheduleMonitor\Support\ScheduledTasks\Tasks\Task;

class ScheduledTaskFactory
{
    public static function createForEvent(Event $event): Task
    {
        $taskClass = collect([
            ClosureTask::class,
            JobTask::class,
            CommandTask::class,
            ShellTask::class,
        ])
            ->first(fn (string $taskClass) => $taskClass::canHandleEvent($event));

        return new $taskClass($event);
    }
}
