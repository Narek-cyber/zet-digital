<?php

namespace App\Jobs;

use App\Mail\PostEmail;
use App\Mail\TestMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class PostNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected $emails,
        protected $posts
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
//        Mail::to($this->emails)->send(new PostEmail($this->posts));
        Mail::to(['narsahakyan.work@gmail.com', 'nsahakyan.work@gmail.com'])->send(new PostEmail($this->posts));
    }
}
