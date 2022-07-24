# Sample Pure PHP Bot

Create a BOT  https://developers.line.biz/console/

### Installation

```
composer require vanchaiy/line-sdk-php
```

### Create file TestBot.php

```php

<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require __DIR__ . '/vendor/autoload.php';

$response = '';
$userId = 'U1a0830f2.....bee4085bf';
$groupId = 'Cf903b.....0005458';
$roomId = 'Akd[65s....occs84ss';
$requestId = 'cssd55....145eg1r';

$lineBot = new LineSDK\Bot([
    "channelID" => "1655...564",
    "channelSecret" => "4be9dec0ed8.....6d817f3",
    "channelAccessToken" => "BO1F1QkMf7H9nHtZ/D.....4t89/1O/w1cDnyilFU=",
]);

switch ($_GET['go'] ?? null) {
    // Send push message
    case 'bot-info':
        $response = $lineBot->info();
        break;

    case 'bot-push-text':
        $response = $lineBot->push($userId)->text('Hello Bot push message');
        break;

    case 'bot-push-sticker':
        $response = $lineBot->push($userId)->sticker(1, 1);
        break;

    case 'bot-push-image':
        $response = $lineBot->push($userId)->image('https://github.githubassets.com/images/modules/logos_page/Octocat.png');
        break;

    case 'bot-push-video':
        $response = $lineBot->push($userId)->video('https://file-examples.com/storage/fe482172fd62d9e089ea96e/2017/04/file_example_MP4_480_1_5MG.mp4', 'https://file-examples.com/storage/fe482172fd62d9e089ea96e/2017/10/file_example_JPG_100kB.jpg');
        break;

    case 'bot-push-location':
        $response = $lineBot->push($userId)->location('my location', '1-6-1 Yotsuya, Shinjuku-ku, Tokyo, 160-0004, Japan', 35.687574, 139.72922);
        break;

    case 'bot-push-json':
        $response = $lineBot->push($userId)->json('[
            {
                "type":"text",
                "text":"Hello, world1"
            },
            {
                "type":"text",
                "text":"Hello, world2"
            }
        ]');
        break;

    case 'bot-push-build':
        $response = $lineBot->push($userId)->build(function ($message) {
            $build[] = $message->text('Hello A');
            $build[] = $message->text('Hello B');
            return $build;
        });
        break;

    // Send multicast message

    case 'bot-multicast-text':
        $response = $lineBot->multicast([$userId])->text('Hello Bot multicast message');
        break;

    case 'bot-multicast-sticker':
        $response = $lineBot->multicast([$userId])->sticker(1, 1);
        break;

    case 'bot-multicast-image':
        $response = $lineBot->multicast([$userId])->image('https://github.githubassets.com/images/modules/logos_page/Octocat.png');
        break;

    case 'bot-multicast-video':
        $response = $lineBot->multicast([$userId])->video('https://file-examples.com/storage/fe482172fd62d9e089ea96e/2017/04/file_example_MP4_480_1_5MG.mp4', 'https://file-examples.com/storage/fe482172fd62d9e089ea96e/2017/10/file_example_JPG_100kB.jpg');
        break;

    case 'bot-multicast-location':
        $response = $lineBot->multicast([$userId])->location('my location', '1-6-1 Yotsuya, Shinjuku-ku, Tokyo, 160-0004, Japan', 35.687574, 139.72922);
        break;

    case 'bot-multicast-json':
        $response = $lineBot->multicast([$userId])->json('[
                {
                    "type":"text",
                    "text":"Hello, world1"
                },
                {
                    "type":"text",
                    "text":"Hello, world2"
                }
            ]');
        break;

    case 'bot-multicast-build':
        $response = $lineBot->multicast([$userId])->build(function ($message) {
            $build[] = $message->text('Hello A');
            $build[] = $message->text('Hello B');
            return $build;
        });
        break;

    // Send broadcast message

    case 'bot-broadcast-text':
        $response = $lineBot->broadcast()->text('Hello Bot broadcast message');
        break;

    case 'bot-broadcast-sticker':
        $response = $lineBot->broadcast()->sticker(1, 1);
        break;

    case 'bot-broadcast-image':
        $response = $lineBot->broadcast()->image('https://github.githubassets.com/images/modules/logos_page/Octocat.png');
        break;

    case 'bot-broadcast-video':
        $response = $lineBot->broadcast()->video('https://file-examples.com/storage/fe482172fd62d9e089ea96e/2017/04/file_example_MP4_480_1_5MG.mp4', 'https://file-examples.com/storage/fe482172fd62d9e089ea96e/2017/10/file_example_JPG_100kB.jpg');
        break;

    case 'bot-broadcast-location':
        $response = $lineBot->broadcast()->location('my location', '1-6-1 Yotsuya, Shinjuku-ku, Tokyo, 160-0004, Japan', 35.687574, 139.72922);
        break;

    case 'bot-broadcast-json':
        $response = $lineBot->broadcast()->json('[
                {
                    "type":"text",
                    "text":"Hello, world1"
                },
                {
                    "type":"text",
                    "text":"Hello, world2"
                }
            ]');
        break;

    case 'bot-broadcast-build':
        $response = $lineBot->broadcast()->build(function ($message) {
            $build[] = $message->text('Hello A');
            $build[] = $message->text('Hello B');
            return $build;
        });
        break;

    // Group chats
    case 'bot-group-summary':
        $response = $lineBot->group($groupId)->summary();
        break;

    case 'bot-group-membersCount':
        $response = $lineBot->group($groupId)->membersCount();
        break;

    case 'bot-group-membersIds':
        $response = $lineBot->group($groupId)->membersIds();
        break;

    case 'bot-group-memberProfile':
        $response = $lineBot->group($groupId)->memberProfile($userId);
        break;

    case 'bot-group-leave':
        $response = $lineBot->group($groupId)->leave();
        break;

    // Multi-person chats (Room)

    case 'bot-room-membersCount':
        $response = $lineBot->room($roomId)->membersCount();
        break;

    case 'bot-room-membersIds':
        $response = $lineBot->room($roomId)->membersIds();
        break;

    case 'bot-room-memberProfile':
        $response = $lineBot->room($roomId)->memberProfile($userId);
        break;

    case 'bot-room-leave':
        $response = $lineBot->room($roomId)->leave();
        break;

    // Insight

    case 'bot-insight-messageDelivery':
        $response = $lineBot->insight()->messageDelivery(20200130);
        break;

    case 'bot-insight-followers':
        $response = $lineBot->insight()->followers(20200130);
        break;

    case 'bot-insight-getFriend':
        $response = $lineBot->insight()->getFriend();
        break;

    case 'bot-insight-statistics':
        $response = $lineBot->insight()->statistics($requestId);
        break;

    // Users

    case 'bot-users-getProfile':
        $response = $lineBot->users()->getProfile($userId);
        break;

    case 'bot-users-membersIds':
        $response = $lineBot->users()->membersIds();
        break;

    // Channel access token

    case 'bot-oauth-accessToken':
        $response = $lineBot->oauth()->accessToken();

        $file = fopen("access_token.txt","w");
        fwrite($file,$response->body["access_token"]);
        fclose($file);
        break;

    case 'bot-oauth-verify':
        $access_token = file_get_contents('access_token.txt');
        $response = $lineBot->oauth()->verify(trim($access_token));
        break;

    case 'bot-oauth-revoke':
        $access_token = file_get_contents('access_token.txt');
        $response = $lineBot->oauth()->revoke(trim($access_token));
        break;
}

?>

<!DOCTYPE html>
<html>
    <body>

    <h1>Test Bot</h1>

    <p>bot</p>
    <ul>
        <li><a href="?go=bot-info">get info</a></li>
    </ul>

    <h2>Message</h2>
    <p>Send push message</p>
    <ul>
        <li><a href="?go=bot-push-text">pushText</a></li>
        <li><a href="?go=bot-push-sticker">pushSticker</a></li>
        <li><a href="?go=bot-push-image">pushImage</a></li>
        <li><a href="?go=bot-push-video">pushVideo</a></li>
        <li><a href="?go=bot-push-location">pushLocation</a></li>
        <li><a href="?go=bot-push-json">pushJson</a></li>
        <li><a href="?go=bot-push-build">pushBuild</a></li>
    </ul>

    <p>Send multicast message</p>
    <ul>
        <li><a href="?go=bot-multicast-text">multicastText</a></li>
        <li><a href="?go=bot-multicast-sticker">multicastSticker</a></li>
        <li><a href="?go=bot-multicast-image">multicastImage</a></li>
        <li><a href="?go=bot-multicast-video">multicastVideo</a></li>
        <li><a href="?go=bot-multicast-location">multicastLocation</a></li>
        <li><a href="?go=bot-multicast-json">multicastJson</a></li>
        <li><a href="?go=bot-multicast-build">multicastBuild</a></li>
    </ul>

    <p>Send broadcast message</p>
    <ul>
        <li><a href="?go=bot-broadcast-text">broadcastText</a></li>
        <li><a href="?go=bot-broadcast-sticker">broadcastSticker</a></li>
        <li><a href="?go=bot-broadcast-image">broadcastImage</a></li>
        <li><a href="?go=bot-broadcast-video">broadcastVideo</a></li>
        <li><a href="?go=bot-broadcast-location">broadcastLocation</a></li>
        <li><a href="?go=bot-broadcast-json">broadcastJson</a></li>
        <li><a href="?go=bot-broadcast-build">broadcastBuild</a></li>
    </ul>

    <h2>Group chats</h2>
    <ul>
        <li><a href="?go=bot-group-summary">Get group chat summary</a></li>
        <li><a href="?go=bot-group-membersCount">Get number of users in a group chat</a></li>
        <li><a href="?go=bot-group-membersIds">Get group chat member user IDs</a></li>
        <li><a href="?go=bot-group-memberProfile">Get group chat member profile</a></li>
        <li><a href="?go=bot-group-leave">Leave group chat</a></li>
    </ul>

    <h2>Multi-person chats (Room)</h2>
    <ul>
        <li><a href="?go=bot-room-membersCount">Get number of users in a multi-person chat</a></li>
        <li><a href="?go=bot-room-membersIds">Get multi-person chat member user IDs</a></li>
        <li><a href="?go=bot-room-memberProfile">Get multi-person chat member profile</a></li>
        <li><a href="?go=bot-room-leave">Leave multi-person chat</a></li>
    </ul>
    
    <h2>Insight</h2>
    <ul>
        <li><a href="?go=bot-insight-messageDelivery">Get number of message deliveries</a></li>
        <li><a href="?go=bot-insight-followers">Get number of followers</a></li>
        <li><a href="?go=bot-insight-getFriend">Get friend demographics</a></li>
        <li><a href="?go=bot-insight-statistics">Get user interaction statistics</a></li>
    </ul>

    <h2>Users</h2>
    <ul>
        <li><a href="?go=bot-users-getProfile">Get profile</a></li>
        <li><a href="?go=bot-users-membersIds">Get a list of users who added your LINE Official Account as a friend</a></li>
    </ul>

    <h2>Channel access token</h2>
    <ul>
        <li><a href="?go=bot-oauth-accessToken">accessToken</a></li>
        <li><a href="?go=bot-oauth-verify">Verify</a></li>
        <li><a href="?go=bot-oauth-revoke">Revoke</a></li>
    </ul>
    
    <p>response</p>
    
    <textarea rows="20" cols="100">
    <?php print_r($response);?>
    </textarea>
    
    </body>
</html>

```

## Test

-`url` :  http://........./TestBot.php

