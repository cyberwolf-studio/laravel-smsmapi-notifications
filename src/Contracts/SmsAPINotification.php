<?php

namespace CyberWolfStudio\LaravelSmsAPINotifications\Contracts;

use App\Models\User;
use CyberWolfStudio\LaravelSmsAPINotifications\SmsAPIMessage;

interface SmsAPINotification
{
    public function toSmsAPI(User $notifiable): SmsAPIMessage;
}
