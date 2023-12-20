# Sample Pure PHP Webhooks

Create a BOT  https://developers.line.biz/console/

### Installation

```
composer require vanchaiy/line-sdk-php
```

### Create file TestWebhook.php

```php
<?php

require __DIR__ . '/vendor/autoload.php';

$lineBot = new LineSDK\Bot([
    "channelID" => "1655...564",
    "channelSecret" => "4be9dec0ed8.....6d817f3",
    "channelAccessToken" => "BO1F1QkMf7H9nHtZ/D.....4t89/1O/w1cDnyilFU=",
]);

$response = $lineBot->webhooks()->events();
foreach ($response as $event) {
    $lineBot->reply($event->replyToken)->text(json_encode($event));
}

echo 'ready';
```

## Setup Messaging API

https://developers.line.biz/console/

### Webhook settings

```
Webhook URL = https://............./TestWebhook.php

Use webhook = On

Click the Verify button, if it shows 200 status, it works.
```

## Test

Send messages from the app After that there will be a reply message.

