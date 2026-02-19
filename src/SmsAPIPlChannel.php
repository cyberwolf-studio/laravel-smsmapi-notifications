<?php

namespace CyberWolfStudio\LaravelSmsAPINotifications;

use CyberWolfStudio\LaravelSmsAPINotifications\Contracts\SmsAPINotification;
use Smsapi\Client\Feature\Sms\Bag\SendSmsBag;
use Smsapi\Client\Feature\Sms\Bag\SendSmsToGroupBag;
use Smsapi\Client\Feature\Sms\Data\Sms;
use Smsapi\Client\Feature\Sms\SmsFeature;

final readonly class SmsAPIPlChannel
{
    public function __construct(
        private SmsFeature $feature
    ) {}

    /**
     * @return Sms|Sms[]
     * */
    public function send($notifiable, SmsAPINotification $notification): Sms|array
    {
        $message = $notification->toSmsapi($notifiable);

        return match (true) {
            ! is_null($group = $notifiable->routeNotificationFor('smsapi_group')) => $this->feature->sendSmsToGroup(SendSmsToGroupBag::withMessage($group, $message->content)),
            default => $this->feature->sendSms(SendSmsBag::withMessage($notifiable->routeNotificationFor('smsapi'), $message->content)),
        };

    }
}
