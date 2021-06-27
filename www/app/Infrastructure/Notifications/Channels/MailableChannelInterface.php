<?php

namespace pkmnfriends\Infrastructure\Notifications\Channels;

use pkmnfriends\Infrastructure\Notifications\Notification;

interface MailableChannelInterface
{

    /**
     * Send the given notification.
     *
     * @param  mixed $notifiable
     * @param  Notification $notification
     */
    public function send($notifiable, Notification $notification);
}
