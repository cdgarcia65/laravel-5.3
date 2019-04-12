<?php

namespace App\Notifications;

use App\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Messages\SlackAttachment;

class PostPublished extends Notification
{
    use Queueable;

    protected $post;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack()
    {
        return (new SlackMessage())
            ->success()
            ->from('David')
            ->content("A new Post was published")
            ->attachment(function (SlackAttachment $attachment) {
                $attachment->title($this->post->title, $this->post->url)
                    ->fields([
                        'points' => $this->post->points,
                        'author' => 'David García',
                        'category' => 'Laravel'
                    ]);
            });
    }
}
