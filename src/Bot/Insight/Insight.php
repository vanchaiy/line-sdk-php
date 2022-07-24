<?php

namespace LineSDK\Bot\Insight;

use LineSDK\Curl\Request;

class Insight
{
    public function __construct(string $channelAccessToken)
    {
        $this->request = new Request([
            'Authorization: Bearer ' . $channelAccessToken,
        ]);
    }

    /*
    |
    | Get number of message deliveries
    | รับจำนวนการส่งข้อความ
    | https://developers.line.biz/en/reference/messaging-api/#get-number-of-delivery-messages
    |
    |*/

    public function messageDelivery(string $date)
    {
        return $this->request->get('https://api.line.me/v2/bot/insight/message/delivery?date=' . $date);
    }

    /*
    |
    | Get number of followers
    | รับจำนวนผู้ติดตาม
    | https://developers.line.biz/en/reference/messaging-api/#get-number-of-followers
    |
    |*/

    public function followers(string $date)
    {
        return $this->request->get('https://api.line.me/v2/bot/insight/followers?date=' . $date);
    }

    /*
    |
    | Get friend demographics
    | รับข้อมูลประชากรของเพื่อน
    | https://developers.line.biz/en/reference/messaging-api/#get-demographic
    |
    |*/

    public function getFriend()
    {
        return $this->request->get('https://api.line.me/v2/bot/insight/demographic');
    }

    /*
    |
    | Get user interaction statistics
    | รับสถิติการโต้ตอบกับผู้ใช้
    | https://developers.line.biz/en/reference/messaging-api/#get-message-event
    |
    |*/

    public function statistics(string $requestId)
    {
        return $this->request->get('https://api.line.me/v2/bot/insight/message/event?requestId=' . $requestId);
    }
}
