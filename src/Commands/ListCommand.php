<?php

namespace logvieweradarsh\ScheduleMonitor\Commands;

use Illuminate\Console\Command;
use logvieweradarsh\ScheduleMonitor\Commands\Tables\DuplicateTasksTable;
use logvieweradarsh\ScheduleMonitor\Commands\Tables\MonitoredTasksTable;
use logvieweradarsh\ScheduleMonitor\Commands\Tables\ReadyForMonitoringTasksTable;
use logvieweradarsh\ScheduleMonitor\Commands\Tables\UnnamedTasksTable;

class ListCommand extends Command
{
    public $signature = 'schedule-monitor:list';

    public $description = 'Display monitored scheduled tasks';

    public function handle()
    {
        (new MonitoredTasksTable($this))->render();
        (new ReadyForMonitoringTasksTable($this))->render();
        (new UnnamedTasksTable($this))->render();
        (new DuplicateTasksTable($this))->render();

        $this->line('');
    }
}
