<?php

namespace LineSDK;

use LineSDK\Bot\Group\Group;
use LineSDK\Bot\Insight\Insight;
use LineSDK\Bot\Message\BroadcastMessage;
use LineSDK\Bot\Message\MessageApi;
use LineSDK\Bot\Message\MultiMessage;
use LineSDK\Bot\Message\PushMessage;
use LineSDK\Bot\Message\ReplyMessage;
use LineSDK\Bot\Oauth\Oauth;
use LineSDK\Bot\Room\Room;
use LineSDK\Bot\Users\Users;
use LineSDK\Bot\Webhooks\Webhooks;
use LineSDK\Curl\Request;

class Bot
{
    public function __construct(array $config = [])
    {
        $this->channelID = $config["channelID"];
        $this->channelSecret = $config["channelSecret"];
        $this->channelAccessToken = $config["channelAccessToken"];
    }

    /*
    |
    | Send reply message
    | ส่งข้อความตอบกลับ
    | https://developers.line.biz/en/reference/messaging-api/#send-reply-message
    |
    |*/

    public function reply(string $replyToken)
    {
        return new ReplyMessage($this->channelAccessToken, $replyToken);
    }

    /*
    |
    | Send push message
    | ส่งข้อความพุช
    | https://developers.line.biz/en/reference/messaging-api/#send-push-message
    |
    |*/

    public function push(string $userId)
    {
        return new PushMessage($this->channelAccessToken, $userId);
    }

    /*
    |
    | Send multicast message
    | ส่งข้อความหลายผู้รับ
    | https://developers.line.biz/en/reference/messaging-api/#send-multicast-message
    |
    |*/

    public function multicast(array $userId)
    {
        return new MultiMessage($this->channelAccessToken, $userId);
    }

    /*
    |
    | Send broadcast message
    | ส่งข้อความออกอากาศ
    | https://developers.line.biz/en/reference/messaging-api/#send-broadcast-message
    |
    |*/

    public function broadcast()
    {
        return new BroadcastMessage($this->channelAccessToken);
    }

    /*
    |
    | Message
    | ข้อความ
    | https://developers.line.biz/en/reference/messaging-api/#messages
    |
    |*/

    public function message()
    {
        return new MessageApi($this->channelAccessToken);
    }

    /*
    |
    | Channel access token
    | โทเค็นการเข้าถึงช่อง
    | https://developers.line.biz/en/reference/messaging-api/#channel-access-token
    |
    |*/

    public function oauth()
    {
        return new Oauth($this->channelID, $this->channelSecret, $this->channelAccessToken);
    }

    /*
    |
    | Webhooks
    | เว็บฮุค
    | https://developers.line.biz/en/reference/messaging-api/#webhooks
    |
    |*/

    public function webhooks()
    {
        return new Webhooks($this->channelAccessToken);
    }

    /*
    |
    | Group chats
    | แชทกลุ่ม
    | https://developers.line.biz/en/reference/messaging-api/#group
    |
    |*/

    public function group(string $groupId)
    {
        return new Group($this->channelAccessToken, $groupId);
    }

    /*
    |
    | Multi-person chats
    | แชทหลายคน
    | https://developers.line.biz/en/reference/messaging-api/#chat-room
    |
    |*/

    public function room(string $roomId)
    {
        return new Room($this->channelAccessToken, $roomId);
    }

    /*
    |
    | Users
    | ผู้ใช้
    | https://developers.line.biz/en/reference/messaging-api/#users
    |
    |*/

    public function users()
    {
        return new Users($this->channelAccessToken);
    }

    /*
    |
    | Insight
    | ข้อมูลเชิงลึก
    | https://developers.line.biz/en/reference/messaging-api/#get-insight
    |
    |*/

    public function insight()
    {
        return new Insight($this->channelAccessToken);
    }

    /*
    |
    | Get bot info
    | รับข้อมูลบอท
    | https://developers.line.biz/en/reference/messaging-api/#get-bot-info
    |
    |*/

    public function info()
    {
        $request = new Request([
            'Authorization: Bearer ' . $this->channelAccessToken,
        ]);
        return $request->get('https://api.line.me/v2/bot/info');
    }

}
