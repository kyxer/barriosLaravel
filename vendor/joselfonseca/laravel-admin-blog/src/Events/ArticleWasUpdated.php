<?php

namespace Joselfonseca\LaravelAdminBlog\Events;

use Joselfonseca\LaravelAdmin\Events\Event;
use Illuminate\Queue\SerializesModels;
use Joselfonseca\LaravelAdminBlog\Services\Article;

class ArticleWasUpdated extends Event
{
    use SerializesModels;

    public $article;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
