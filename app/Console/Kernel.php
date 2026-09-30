<?php

namespace App\Console;

use App\Models\ServiceRequest;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /** Lịch tự động xóa ticket đã hoàn thành quá 90 ngày vào 02:00 mỗi ngày. */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            ServiceRequest::query()
                ->where('status', 'done')
                ->where('updated_at', '<', now()->subDays(90))
                ->delete();
        })
            ->name('delete-old-completed-service-requests')
            ->dailyAt('02:00')
            ->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
