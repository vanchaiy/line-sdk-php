# Sample Laravel Project Webhooks

https://developers.line.biz/en/reference/messaging-api/#webhooks

Create a BOT https://developers.line.biz/console/

## Installation

Create Laravel Project

```
composer create-project laravel/laravel lineWebhook
```

When the installation is complete

```
cd lineWebhook
```

Install the library

```
composer require vanchaiy/line-sdk-php
```

```
php artisan vendor:publish --provider="LineSDK\Laravel\LineServiceProvider"
```


## Config
### Add .env

```php

LINE_BOT_CHANNEL_ID=1655...564
LINE_BOT_CHANNEL_SECRET=4be9dec0ed8.....6d817f3
LINE_BOT_CHANNEL_TOKEN=BO1F1QkMf7H9nHtZ/D.....4t89/1O/w1cDnyilFU=

```

### Edit config/app.php

```php

'providers' => [
      LineSDK\Laravel\LineServiceProvider::class,
  ],
  
```

```php

'aliases' => [
      'LineBot' => LineSDK\Laravel\Facades\LineBot::class,
  ],
  
```

### Add routes/api.php

```php

use App\Http\Controllers\lineWebhookDemo;

Route::controller(lineWebhookDemo::class)->group(function () {
    // lineWebhook
    Route::match(['get', 'post'], '/linebot/webhook', 'webhook');
});

```

## Controller


### Create controller

```
php artisan make:controller lineWebhookDemo
```

### Edit  app/Http/Controllers/lineWebhookDemo.php

```php

namespace App\Http\Controllers;

use LineBot;

class lineWebhookDemo extends Controller
{
    public function webhook()
    {
        return 'ready';
    }
 }
```

## Setup Messaging API

https://developers.line.biz/console/

### Webhook settings

```
Webhook URL = https://............./api/linebot/webhook

Use webhook = On

Click the Verify button, if it shows 200 status, it works.
```

### Edit  app/Http/Controllers/lineWebhookDemo.php

```php

namespace App\Http\Controllers;

use LineBot;

class lineWebhookDemo extends Controller
{
    public function webhook()
    {
        $response = LineBot::webhooks()->events();
        if($response){
          LineBot::reply($response->replyToken)->text(json_encode($response));
        }

        return 'ready';
    }
 }
```

## Test

Send messages from the app After that there will be a reply message.
