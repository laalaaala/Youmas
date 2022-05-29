<?php

namespace App\Console\Commands;

use App\Models\StripeSubscription;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeactivateDueSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:deactivate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivates due subscriptions';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /**
         * Deactivate due subscriptions
         */

        $subscriptions = StripeSubscription::where('status', 'cancelled')->orWhere('status', 'trial')
            ->where('due_date', '<=', Carbon::now()
                ->toDateTimeString())
            ->get();

        foreach ($subscriptions as $subscription) {
            $subscription->status = 'inactive';
            $subscription->save();
        }
    }
}
