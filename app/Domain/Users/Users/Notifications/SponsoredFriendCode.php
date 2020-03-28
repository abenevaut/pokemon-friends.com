<?php

namespace template\Domain\Users\Users\Notifications;

use NotificationChannels\Twitter\TwitterChannel;
use NotificationChannels\Twitter\TwitterStatusUpdate;
use template\App\Notifications\Messages\CustomerMailMessage;
use template\Domain\Users\Users\User;
use template\Infrastructure\Contracts\Notifications\Notification;

class SponsoredFriendCode extends Notification
{

    /**
     * @var User
     */
    protected $user;

    /**
     * CreatedAccountByAdministrator constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $channels = [
            'mail',
        ];

        if (app()->environment('production')) {
            $channels[] = TwitterChannel::class;
        }

        return $channels;
    }

    public function toTwitter($notifiable)
    {
        return new TwitterStatusUpdate(
            "A trainer, {$this->user->profile->formated_friend_code}, is looking for new friends! #PokemonGo #pokemonfriends #GOBattle"
        );
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new CustomerMailMessage())
            ->subject('You joined our sponsored trainers')
            ->view(
                'emails.users.users.sponsored_friend_code',
                [
                    'friend_code' => $this->user->profile->formated_friend_code
                ]
            );
    }
}
