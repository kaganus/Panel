<?php

namespace Pterodactyl\Notifications;

use Pterodactyl\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AccountCreated extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The authentication token to be used for the user to set their
     * password for the first time.
     *
     * @var string|null
     */
    public $token;

    /**
     * The user model for the created user.
     *
     * @var \Pterodactyl\Models\User
     */
    public $user;

    /**
     * Create a new notification instance.
     *
     * @param \Pterodactyl\Models\User $user
     * @param string|null              $token
     */
    public function __construct(User $user, string $token = null)
    {
        $this->token = $token;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $message = (new MailMessage)
            ->subject(trans('email.account_created.subject'))
            ->greeting(trans('email.common.greeting') . ' ' . $this->user->name . '!')
            ->line(trans('email.account_created.content'))
            ->line(trans('email.common.username') . $this->user->username)
            ->line(trans('email.common.email') . $this->user->email);

        if (! is_null($this->token)) {
            return $message->action(trans('email.account_created.link'), url('/auth/password/reset/' . $this->token . '?email=' . urlencode($this->user->email)));
        }

        return $message;
    }
}
