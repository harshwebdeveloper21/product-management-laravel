<?php

use App\Console\Commands\SendWelcomeEmails;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule the welcome emails to be sent every minute for testing
Schedule::command(SendWelcomeEmails::class)->everyMinute();

// For production, you might want to run it hourly:
// Schedule::command(SendWelcomeEmails::class)->hourly();
