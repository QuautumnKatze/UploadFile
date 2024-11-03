<?php

namespace App\Console\Commands;

use App\Models\galleries;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExpiringFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:expiring-file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'File uploaded will be deleted if expired';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the current date and time
        $now = Carbon::now();

        // Query to find and delete expired records
        galleries::where('expired_date', '<', $now)->delete();

        // Output the result to the console
        $this->info("expired record(s) deleted from the gallery.");
    }
}
