<?php

namespace CyberWolfStudio\LaravelSmsAPINotifications;

final readonly class SmsAPIMessage
{
    public function __construct(
        public string $content
    ) {}

}
