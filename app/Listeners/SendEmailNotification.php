<?php

namespace App\Listeners;

use App\Events\EmailProcessed;
use App\Mail\SubscribtionEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EmailProcessed $event): void
    {
        Mail::to($event->email)->send(new SubscribtionEmail($event->url, $event->name));
    }
}
