# Sample Laravel Project Notify

Generate tokens  https://notify-bot.line.me/my/

## Installation

Create Laravel Project

```
composer create-project laravel/laravel lineNotify
```

When the installation is complete

```
cd lineNotify
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

LINE_NOTIFY_TOKEN=Fs2RWGHjr....aSD0SDxGj

```

### Edit config/app.php

```php

'providers' => [
      LineSDK\Laravel\LineServiceProvider::class,
  ],
  
```

```php

'aliases' => [
      'LineNotify' => LineSDK\Laravel\Facades\LineNotify::class,
  ],
  
```

### Add routes/api.php

```php

use App\Http\Controllers\LineNotifyDemo;

Route::controller(LineNotifyDemo::class)->group(function () {
    // Notification
    Route::get('/linenotify/send/text', 'text');
    Route::get('/linenotify/send/sticker', 'sticker');
    Route::get('/linenotify/send/image', 'image');
    Route::get('/linenotify/send/imageFile', 'imageFile');
    Route::get('/linenotify/send/multi', 'multi');
    // Other
    Route::get('/linenotify/status', 'status');
    Route::get('/linenotify/revoke', 'revoke');
});

```

## Controller


### Create controller

```
php artisan make:controller LineNotifyDemo
```

### Edit  app/Http/Controllers/LineNotifyDemo.php

```php

namespace App\Http\Controllers;

use LineNotify;

class LineNotifyDemo extends Controller
{
    // Notification

    public function text()
    {
        return LineNotify::send()->text('Hello LineNotify');
    }

    public function sticker()
    {
        return LineNotify::send()->sticker('Hello sticker', 1, 1);
    }

    public function image()
    {
        return LineNotify::send()->image('Hello image', 'https://github.githubassets.com/images/modules/logos_page/Octocat.png');
    }

    public function imageFile()
    {
        return LineNotify::send()->imageFile('Hello imageFile', dirname(__FILE__, 4) . '\vendor\vanchaiy\line-sdk-php\test\demo.jpg');
    }

    public function multi()
    {
        return LineNotify::send()->multi([
            'message' => 'Hello multi message',
            'stickerPackageId' => 1,
            'stickerId' => 1,
            'imageFullsize' => 'https://github.githubassets.com/images/modules/logos_page/Octocat.png',
            'imageThumbnail' => 'https://github.githubassets.com/images/modules/logos_page/Octocat.png',
            'imageFile' => new \CURLFile(dirname(__FILE__, 4) . '\vendor\vanchaiy\line-sdk-php\test\demo.jpg'),
        ]);
    }

    // Other

    public function status()
    {
        return LineNotify::status();
    }

    public function revoke()
    {
        return LineNotify::revoke();
    }
}

```

## Run serve

```
php artisan serve
```

## Test

-`text` :  http://localhost:8000/api/linenotify/send/text

-`sticker` :  http://localhost:8000/api/linenotify/send/sticker
 
-`image` :  http://localhost:8000/api/linenotify/send/image

-`imageFile` :  http://localhost:8000/api/linenotify/send/imageFile

-`multi` :  http://localhost:8000/api/linenotify/send/multi

-`status` :  http://localhost:8000/api/linenotify/status

-`revoke` :  http://localhost:8000/api/linenotify/revoke

