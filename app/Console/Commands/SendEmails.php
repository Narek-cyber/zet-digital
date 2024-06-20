<?php

namespace App\Console\Commands;

use App\Jobs\PostNotification;
use App\Models\Post;
use App\Models\Subscriber;
use Illuminate\Console\Command;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load all posts and send them to website subscribers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $emails = Subscriber::all()->pluck('email')->toArray();
        $posts = Post::query()->where('email_sent', false)->get()->toArray();

        PostNotification::dispatch($emails, $posts)->onQueue('emails');
    }
}
