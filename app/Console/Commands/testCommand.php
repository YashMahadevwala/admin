<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class testCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Email command triel.';

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
        $data = [
            'subject' => 'Task Scheduling',
            'email' => 'trainee15.dynamicdreamz@gmail.com',
        ];

        Mail::send('mail.test', $data, function($message) use ($data) {
            $message->to($data['email'])
            ->subject($data['subject']);
        });

          echo "Email Send Successfully !  ";
     

    }
}
