<?php

namespace App\Listeners;

use App\Events\PostCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

class PostCreatedListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(PostCreatedEvent $event): void
    {
        $post = $event->post;
        $post->user->notify(new PostCreatedNotification($post));
    }
}
