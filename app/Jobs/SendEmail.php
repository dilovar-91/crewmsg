<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\NewUserNotification;
use Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $details;
    public $timeout = 80;
  
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    
    public function handle()
    {
        
        Mail::to($this->details['email'])->send(new NewUserNotification($this->details));
        return 'A message has been sent!';
    }

    
}
