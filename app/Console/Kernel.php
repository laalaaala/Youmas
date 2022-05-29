<?php

namespace App\Console;

use App\Http\Controllers\Admin\AdminBookingController;
use App\Mail\BookingCompletedMailable;
use App\Models\Bookings;
use App\Models\BusinessReview;
use App\Models\StripeSubscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;
use Ramsey\Uuid\Uuid;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\ChangeBookingsToComplete::class,
        Commands\DeactivateDueSubscriptions::class,
        Commands\EmailReminders::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('bookings:complete')->everyMinute();
        $schedule->command('subscriptions:deactivate')->everyMinute();
        $schedule->command('booking:reminder')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
