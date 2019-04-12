<?php

namespace App;

use Illuminate\Notifications\RoutesNotifications;

class SlackTeam
{
    use RoutesNotifications;

    public function routeNotificationForSlack()
    {
        return config('services.slack.webhook_url');
    }
}
