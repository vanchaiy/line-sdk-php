
# Sample Laravel Project Bot

Create a BOT https://developers.line.biz/console/

## Installation

Create Laravel Project

```
composer create-project laravel/laravel lineBot
```

When the installation is complete

```
cd lineBot
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

use App\Http\Controllers\LineBotDemo;

Route::controller(LineBotDemo::class)->group(function () {
    // bot
    Route::get('/linebot/info', 'info');
    // Send push message
    Route::get('/linebot/push/text', 'pushText');
    Route::get('/linebot/push/sticker', 'pushSticker');
    Route::get('/linebot/push/image', 'pushImage');
    Route::get('/linebot/push/video', 'pushVideo');
    Route::get('/linebot/push/location', 'pushLocation');
    Route::get('/linebot/push/json', 'pushJson');
    Route::get('/linebot/push/build', 'pushBuild');
    // Send multicast message
    Route::get('/linebot/multicast/text', 'multicastText');
    Route::get('/linebot/multicast/sticker', 'multicastSticker');
    Route::get('/linebot/multicast/image', 'multicastImage');
    Route::get('/linebot/multicast/video', 'multicastVideo');
    Route::get('/linebot/multicast/location', 'multicastLocation');
    Route::get('/linebot/multicast/json', 'multicastJson');
    Route::get('/linebot/multicast/build', 'multicastBuild');
    // Send broadcast message
    Route::get('/linebot/broadcast/text', 'broadcastText');
    Route::get('/linebot/broadcast/sticker', 'broadcastSticker');
    Route::get('/linebot/broadcast/image', 'broadcastImage');
    Route::get('/linebot/broadcast/video', 'broadcastVideo');
    Route::get('/linebot/broadcast/location', 'broadcastLocation');
    Route::get('/linebot/broadcast/json', 'broadcastJson');
    Route::get('/linebot/broadcast/build', 'broadcastBuild');
    // Group chats
    Route::get('/linebot/group/summary', 'groupSummary');
    Route::get('/linebot/group/membersCount', 'groupMembersCount');
    Route::get('/linebot/group/membersIds', 'groupMembersIds');
    Route::get('/linebot/group/memberProfile', 'groupMemberProfile');
    Route::get('/linebot/group/leave', 'groupLeave');
    // Multi-person chats (Room)
    Route::get('/linebot/room/membersCount', 'roomMembersCount');
    Route::get('/linebot/room/membersIds', 'roomMembersIds');
    Route::get('/linebot/room/memberProfile', 'roomMemberProfile');
    Route::get('/linebot/room/leave', 'roomLeave');
    // Insight
    Route::get('/linebot/insight/messageDelivery', 'insightMessageDelivery');
    Route::get('/linebot/insight/followers', 'insightFollowers');
    Route::get('/linebot/insight/getFriend', 'insightGetFriend');
    Route::get('/linebot/insight/statistics', 'insightStatistics');
    // Users
    Route::get('/linebot/users/getProfile', 'usersGetProfile');
    Route::get('/linebot/users/membersIds', 'usersMembersIds');
    // Channel access token
    Route::get('/linebot/oauth/accessToken', 'oauthAccessToken');
    Route::get('/linebot/oauth/verify', 'oauthVerify');
    Route::get('/linebot/oauth/revoke', 'oauthRevoke');

});

```

## Controller


### Create controller

```
php artisan make:controller LineBotDemo
```

### Edit  app/Http/Controllers/LineBotDemo.php

```php

namespace App\Http\Controllers;

use LineBot;

class LineBotDemo extends Controller
{

    public function __construct($headers = [])
    {
        $this->userId = 'U1a0830f....4085bf';
        $this->groupId = 'Cf903b.....0005458';
        $this->roomId  = 'Akd[65s....occs84ss';
        $this->requestId = 'cssd55....145eg1r';
    }
    
    public function webhook()
    {
        $response = LineBot::webhooks()->events();
        if($response){
          LineBot::reply($response->replyToken)->json(json_encode($response));
        }
    }

    // bot
    
    public function info()
    {
        return LineBot::info();
    }
    
    // Send push message
    
    public function pushText()
    {
        return LineBot::push($this->userId)->text('Hello Bot push message');
    }
    
    public function pushSticker()
    {
        return LineBot::push($this->userId)->sticker(1, 1);
    }
    
    public function pushImage()
    {
        return LineBot::push($this->userId)->image('https://github.githubassets.com/images/modules/logos_page/Octocat.png');
    }
    
    public function pushVideo()
    {
        return LineBot::push($this->userId)->video('https://file-examples.com/storage/fe482172fd62d9e089ea96e/2017/04/file_example_MP4_480_1_5MG.mp4', 'https://file-examples.com/storage/fe482172fd62d9e089ea96e/2017/10/file_example_JPG_100kB.jpg');
    }
    
    public function pushLocation()
    {
        return LineBot::push($this->userId)->location('my location', '1-6-1 Yotsuya, Shinjuku-ku, Tokyo, 160-0004, Japan', 35.687574, 139.72922);
    }
    
    public function pushJson()
    {
        return LineBot::push($this->userId)->json('[
            {
                "type":"text",
                "text":"Hello, world1"
            },
            {
                "type":"text",
                "text":"Hello, world2"
            }
        ]');
    }
    
    public function pushBuild()
    {
        return LineBot::push($this->userId)->build(function ($message) {
            $build[] = $message->text('Hello A');
            $build[] = $message->text('Hello B');
            return $build;
        });
    }
    
    // Send multicast message
    
    public function multicastText()
    {
        return LineBot::multicast([$this->userId])->text('Hello Bot push message');
    }
    
    public function multicastSticker()
    {
        return LineBot::multicast([$this->userId])->sticker(1, 1);
    }
    
    public function multicastImage()
    {
        return LineBot::multicast([$this->userId])->image('https://github.githubassets.com/images/modules/logos_page/Octocat.png');
    }
    
    public function multicastVideo()
    {
        return LineBot::multicast([$this->userId])->video('https://file-examples.com/storage/fe482172fd62d9e089ea96e/2017/04/file_example_MP4_480_1_5MG.mp4', 'https://file-examples.com/storage/fe482172fd62d9e089ea96e/2017/10/file_example_JPG_100kB.jpg');
    }
    
    public function multicastLocation()
    {
        return LineBot::multicast([$this->userId])->location('my location', '1-6-1 Yotsuya, Shinjuku-ku, Tokyo, 160-0004, Japan', 35.687574, 139.72922);
    }
    
    public function multicastJson()
    {
        return LineBot::multicast([$this->userId])->json('[
            {
                "type":"text",
                "text":"Hello, world1"
            },
            {
                "type":"text",
                "text":"Hello, world2"
            }
        ]');
    }
    
    public function multicastBuild()
    {
        return LineBot::multicast([$this->userId])->build(function ($message) {
            $build[] = $message->text('Hello A');
            $build[] = $message->text('Hello B');
            return $build;
        });
    }
    
    // Send broadcast message
    
    public function broadcastText()
    {
        return LineBot::broadcast()->text('Hello Bot push message');
    }
    
    public function broadcastSticker()
    {
        return LineBot::broadcast()->sticker(1, 1);
    }
    
    public function broadcastImage()
    {
        return LineBot::broadcast()->image('https://github.githubassets.com/images/modules/logos_page/Octocat.png');
    }
    
    public function broadcastVideo()
    {
        return LineBot::broadcast()->video('https://file-examples.com/storage/fe482172fd62d9e089ea96e/2017/04/file_example_MP4_480_1_5MG.mp4', 'https://file-examples.com/storage/fe482172fd62d9e089ea96e/2017/10/file_example_JPG_100kB.jpg');
    }
    
    public function broadcastLocation()
    {
        return LineBot::broadcast()->location('my location', '1-6-1 Yotsuya, Shinjuku-ku, Tokyo, 160-0004, Japan', 35.687574, 139.72922);
    }
    
    public function broadcastJson()
    {
        return LineBot::broadcast()->json('[
            {
                "type":"text",
                "text":"Hello, world1"
            },
            {
                "type":"text",
                "text":"Hello, world2"
            }
        ]');
    }
    
    public function broadcastBuild()
    {
        return LineBot::broadcast()->build(function ($message) {
            $build[] = $message->text('Hello A');
            $build[] = $message->text('Hello B');
            return $build;
        });
    }
    
    // Group chats
    
    public function groupSummary()
    {
        return LineBot::group($this->groupId)->summary();
    }
    
    public function groupMembersCount()
    {
        return LineBot::group($this->groupId)->membersCount();
    }
    
    public function groupMembersIds()
    {
        return LineBot::group($this->groupId)->membersIds();
    }
    
    public function groupMemberProfile()
    {
        return LineBot::group($this->groupId)->memberProfile($this->userId);
    }
    
     public function groupLeave()
    {
        return LineBot::group($this->groupId)->leave();
    }
    
    // Multi-person chats (Room)
    
    public function roomMembersCount()
    {
        return LineBot::room($this->roomId)->membersCount();
    }
    
    public function roomMembersIds()
    {
        return LineBot::room($this->roomId)->membersIds();
    }
    
    public function roomMemberProfile()
    {
        return LineBot::room($this->roomId)->memberProfile($this->userId);
    }
    
     public function roomLeave()
    {
        return LineBot::room($this->roomId)->leave();
    }
    
    // Insight
    
    public function insightMessageDelivery()
    {
        return LineBot::insight()->messageDelivery(20200130);
    }
    
    public function insightFollowers()
    {
        return LineBot::insight()->followers(20200130);
    }
    
    public function insightGetFriend()
    {
        return LineBot::insight()->getFriend();
    }
    
     public function insightStatistics()
    {
        return LineBot::insight()->statistics($this->requestId);
    }
    
    // Users
    
    public function usersGetProfile()
    {
        return LineBot::users()->getProfile($this->userId);
    }
    
    public function usersMembersIds()
    {
        return LineBot::users()->membersIds();
    }
    
    // Channel access token
    
    public function oauthAccessToken()
    {
        return LineBot::oauth()->accessToken();
    }
    
    public function oauthVerify()
    {
        return LineBot::oauth()->verify($access_token);
    }

    public function oauthRevoke()
    {
        return LineBot::oauth()->revoke($access_token);
    }
   
}

```

## Run serve

```
php artisan serve
```

## Test

### bot
-`info` :  http://localhost:8000/api/linebot/info



### Send push message

-`text` :  http://localhost:8000/api/linebot/push/text

-`sticker` :  http://localhost:8000/api/linebot/push/sticker

-`image` :  http://localhost:8000/api/linebot/push/image

-`location` :  http://localhost:8000/api/linebot/push/location

-`video` :  http://localhost:8000/api/linebot/push/video

-`json` :  http://localhost:8000/api/linebot/push/json

-`build` :  http://localhost:8000/api/linebot/push/build



### Send multicast message

-`text` :  http://localhost:8000/api/linebot/multicast/text

-`sticker` :  http://localhost:8000/api/linebot/multicast/sticker

-`image` :  http://localhost:8000/api/linebot/multicast/image

-`location` :  http://localhost:8000/api/linebot/multicast/location

-`video` :  http://localhost:8000/api/linebot/multicast/video

-`json` :  http://localhost:8000/api/linebot/multicast/json

-`build` :  http://localhost:8000/api/linebot/multicast/build



### Send broadcast message

-`text` :  http://localhost:8000/api/linebot/broadcast/text

-`sticker` :  http://localhost:8000/api/linebot/broadcast/sticker

-`image` :  http://localhost:8000/api/linebot/broadcast/image

-`location` :  http://localhost:8000/api/linebot/broadcast/location

-`video` :  http://localhost:8000/api/linebot/broadcast/video

-`json` :  http://localhost:8000/api/linebot/broadcast/json

-`build` :  http://localhost:8000/api/linebot/broadcast/build



### Group chats

-`Get group chat summary` :  http://localhost:8000/api/linebot/group/summary

-`Get number of users in a group chat` :  http://localhost:8000/api/linebot/group/membersCount

-`Get group chat member user IDs` :  http://localhost:8000/api/linebot/group/membersIds

-`Get group chat member profile` :  http://localhost:8000/api/linebot/group/memberProfile

-`Leave group chat` :  http://localhost:8000/api/linebot/group/leave



### Multi-person chats (Room)

-`Get number of users in a multi-person chat` :  http://localhost:8000/api/linebot/room/membersCount

-`Get multi-person chat member user IDs` :  http://localhost:8000/api/linebot/room/membersIds

-`Get multi-person chat member profile` :  http://localhost:8000/api/linebot/room/memberProfile

-`Leave multi-person chat` :  http://localhost:8000/api/linebot/room/leave



### Insight

-`Get number of message deliveries` :  http://localhost:8000/api/linebot/insight/messageDelivery

-`Get number of followers` :  http://localhost:8000/api/linebot/insight/followers

-`Get friend demographics` :  http://localhost:8000/api/linebot/insight/getFriend

-`Get user interaction statistics` :  http://localhost:8000/api/linebot/insight/statistics



### Users

-`Get profile` :  http://localhost:8000/api/linebot/users/getProfile

-`Get a list of users who added your LINE Official Account as a friend` :  http://localhost:8000/api/linebot/users/membersIds



### Channel access token

-`getAccessToken` :  http://localhost:8000/api/linebot/oauth/accessToken

-`Verify` :  http://localhost:8000/api/linebot/oauth/verify

-`Revoke` :  http://localhost:8000/api/linebot/oauth/revoke


