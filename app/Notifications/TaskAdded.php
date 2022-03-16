<?php

namespace App\Notifications;

use NotificationChannels\PusherPushNotifications\PusherChannel;
use NotificationChannels\PusherPushNotifications\PusherMessage;
use Illuminate\Notifications\Notification;

class TaskAdded extends Notification
{
    public function via($notifiable)
    {
        return [PusherChannel::class];
    }

    public function toPushNotification($notifiable)
    {
        return PusherMessage::create()
            ->android()
            ->badge(1)
            ->sound('success')
            ->body('Pridėta nauja užduotis!')
            ->icon(asset('favicon.ico'))
            ->withWeb(
                PusherMessage::create()
                ->title('Pridėta nauja užduotis')
            );
    }
}
