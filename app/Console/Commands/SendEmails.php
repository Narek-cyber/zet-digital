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
    protected $signature = 'digital:send-emails';

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
        $posts = Post::query()->where('email_sent', false)->get();
        $email_sended_posts = $posts->toArray();

        foreach ($posts as $post) {
            $post->email_sent = true;
            $post->save();
        }

        if (!empty($email_sended_posts)) {
            PostNotification::dispatch($emails, $email_sended_posts)->onQueue('emails');
            $this->info('Posts sent to subscribers successfully.');
        } else {
            $this->info('Posts already sent to subscribers successfully.');
        }
    }
}
