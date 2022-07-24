<p align="center">
    <a href="https://pay.line.me/" target="_blank">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/LINE_logo.svg/220px-LINE_logo.svg.png" width="100px">
    </a>
    <div align="center">
        <h1>LineSDK <i>for</i> PHP</h1>
        <p>LineBot & LineNotify SDK for Pure PHP & Support Laravel</p>
     </div>
    <br>
</p>


# is in development !!!


INSTALLATION
------------

Run Composer in your project:

    composer require vanchaiy/line-sdk-php
    
Then you could use SDK class after Composer is loaded on your PHP project:

```php
require __DIR__ . '/vendor/autoload.php';

$lineNotify = new LineSDK\Bot();
$lineNotify = new LineSDK\Notify();
```

OR

```php
use LineSDK\Bot();
use LineSDK\Notify();
```


## Laravel Configuration

### .env
```
LINE_BOT_CHANNEL_ID=
LINE_BOT_CHANNEL_SECRET=
LINE_BOT_CHANNEL_TOKEN=

LINE_NOTIFY_TOKEN=
```

### config/app.php

```php
    'providers' => [
        LineSDK\Laravel\LineServiceProvider::class,
    ],
```

```php
    'aliases' => [
        'LineBot' => LineSDK\Laravel\Facades\LineBot::class,
        'LineNotify' => LineSDK\Laravel\Facades\LineNotify::class,
    ],
```
Run the following Artisan command in your terminal:

```
php artisan vendor:publish --provider="LineSDK\Laravel\LineServiceProvider"
```

### Test

```php
use LineBot;

LineBot::push('<userToken>')->text('LineBot Test');
```

```php
use LineNotify;

LineNotify::sent()->text('LineNotify Test');
```

## Documents
- [Messaging API / Bot](docs/bot.md)
- [Notifications](docs/notify.md)
