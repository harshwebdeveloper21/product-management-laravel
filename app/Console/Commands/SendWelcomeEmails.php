<?php

namespace App\Console\Commands;

use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-welcome-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send welcome emails to users who have not received one yet';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::whereNull('welcome_email_sent_at')
            ->where('created_at', '<=', now()->subHour())
            ->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new WelcomeEmail($user));
            $user->update(['welcome_email_sent_at' => now()]);
            
            $this->info("Welcome email sent to {$user->email}");
        }

        $this->info('All welcome emails have been sent!');

        return Command::SUCCESS;
    }
}
