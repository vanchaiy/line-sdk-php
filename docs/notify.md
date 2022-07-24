# LINE Notify

https://notify-bot.line.me/

### API

```
->send()...messageobjects

->status();

->revoke();
```

### Message Objects 

```
->text(<text>);

->sticker(<text>, <stickerPackageId>, <stickerId>);

->image(<text>, <originalContentUrl>, <previewImageUrl>); or ->image(<text>, <originalContentUrl>);

->imageFile(<text>, <imageFile>);

->multi(<content>);

```

*Example:*


```
->send()->text('Hello LineNotify');

->send()->sticker('Hello sticker', 1, 1);

->send()->image('Hello image', 'https://github.githubassets.com/images/modules/logos_page/Octocat.png');

->imageFile('Hello imageFile', dirname(__FILE__) . '\vendor\vanchaiy\line-sdk-php\test\demo.jpg');

->send()->multi([
    'message' => 'Hello multi message',
    'stickerPackageId' => 1,
    'stickerId' => 1,
    'imageFullsize' => 'https://github.githubassets.com/images/modules/logos_page/Octocat.png',
    'imageThumbnail' => 'https://github.githubassets.com/images/modules/logos_page/Octocat.png',
    'imageFile' => new \CURLFile(dirname(__FILE__) . '\vendor\vanchaiy\line-sdk-php\test\demo.jpg'),
]);

```

# Usage

## Pure PHP

```
require __DIR__ . '/vendor/autoload.php';

$lineNotify = new LineSDK\Notify();
$lineNotify->send('Fs2RWGHjr....aSD0SDxGj')->text('Hello LineNotify');

```
OR

```
require __DIR__ . '/vendor/autoload.php';

$lineNotify = new LineSDK\Notify('Fs2RWGHjr....aSD0SDxGj');
$lineNotify->send()->text('Hello LineNotify');

```

## Laravel

Then you could use SDK for Laravel Facades

### Edit .env
```
LINE_NOTIFY_TOKEN=Fs2RWGHjr....aSD0SDxGj
```

### Add config/app.php
```php
    'providers' => [
         LineSDK\Laravel\LineServiceProvider::class,
     ],
    
    'aliases' => [
        'LineNotify' => LineSDK\Laravel\Facades\LineNotify::class,
    ],
```

### Then you could use SDK for Laravel Facades

```php
use LineNotify;

LineNotify::send()->text('Hello LineNotify');

OR

LineNotify::send('zOKhJ9....k281wJr')->text('Hello LineNotify');
```

## Notes

Emoji Unicode : https://apps.timwhitlock.info/emoji/tables/unicode

## Sample

- [Pure PHP](sample/purephpnotify.md)
- [Laravel](sample/laravelnotify.md)
