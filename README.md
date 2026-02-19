# SmsAPI Notifications Channel for Laravel

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE.md)

Laravel notification channel for sending SMS via [SmsAPI](https://www.smsapi.pl/). Supports both Polish (`smsapi.pl`) and international (`smsapi.com`) services.

Compatible with Laravel 6.x through 12.x.

## Installation

```bash
composer require cyberwolfstudio/laravel-smsmapi-notifications
```

The service provider is auto-discovered. No manual registration needed.

## Configuration

Add your SmsAPI token to `config/services.php`:

```php
'smsapi' => [
    'token' => env('SMSAPI_AUTH_TOKEN'),
],
```

Optionally set the service region in `config/smsapi.php`:

```php
// 'pl' (default) or 'com'
'service' => env('SMSAPI_SERVICE', 'pl'),
```

## Usage

Implement the `SmsAPINotification` contract on your notification and return an `SmsAPIMessage`:

```php
use Illuminate\Notifications\Notification;
use CyberWolfStudio\LaravelSmsAPINotifications\SmsAPIPlChannel;
use CyberWolfStudio\LaravelSmsAPINotifications\SmsAPIMessage;
use CyberWolfStudio\LaravelSmsAPINotifications\Contracts\SmsAPINotification;

class OrderShipped extends Notification implements SmsAPINotification
{
    public function via($notifiable): array
    {
        return [SmsAPIPlChannel::class];
    }

    public function toSmsAPI($notifiable): SmsAPIMessage
    {
        return new SmsAPIMessage('Your order has been shipped!');
    }
}
```

### Routing

Add a `routeNotificationForSmsapi` method to your notifiable model to return the phone number:

```php
public function routeNotificationForSmsapi(): string
{
    return $this->phone_number;
}
```

To send to a contacts group instead, add `routeNotificationForSmsapiGroup`:

```php
public function routeNotificationForSmsapiGroup(): string
{
    return $this->contacts_group;
}
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
