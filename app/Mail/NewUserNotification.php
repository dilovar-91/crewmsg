<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewUserNotification extends Mailable
{
    use Queueable, SerializesModels;
    protected $details;
    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    

    public function build()
    {
        
        return $this->from('hello@yur-list.ru', 'Crew MSG')
            ->subject('Приглашение на интервью')
            ->markdown('mails.exmpl')
            ->with([
                'name' => $this->details['candidate']['name'],
                'link' => 'https://yur-list.ru/seamen/interview/record/1'
            ]);
    }
}
