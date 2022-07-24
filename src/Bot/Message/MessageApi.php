<?php

namespace LineSDK\Bot\Message;

use LineSDK\Curl\Request;

class MessageApi
{
    public function __construct(string $channelAccessToken)
    {
        $this->request = new Request([
            'content-type: application/json',
            'Authorization: Bearer ' . $channelAccessToken,
        ]);
    }

    /*
    |
    | Get the target limit for sending messages this month
    | รับขีด จำกัด เป้าหมายสำหรับการส่งข้อความในเดือนนี้
    | https://developers.line.biz/en/reference/messaging-api/#get-quota
    |
    |*/

    public function quota()
    {
        return $this->request->get('https://api.line.me/v2/bot/message/quota');
    }

    /*
    |
    | Get number of messages sent this month
    | จำนวนข้อความที่ส่งในเดือนนี้
    | https://developers.line.biz/en/reference/messaging-api/#get-consumption
    |
    |*/

    public function consumption()
    {
        return $this->request->get('https://api.line.me/v2/bot/message/quota/consumption');
    }

    /*
    |
    | Get number of sent reply messages
    | รับจำนวนข้อความตอบกลับที่ส่ง
    | https://developers.line.biz/en/reference/messaging-api/#get-number-of-reply-messages
    |
    |*/

    public function reply(string $date)
    {
        return $this->request->get('https://api.line.me/v2/bot/message/delivery/reply?date=' . $date);
    }

    /*
    |
    | Get number of sent push messages
    | รับจำนวนข้อความพุชที่ส่ง
    | https://developers.line.biz/en/reference/messaging-api/#get-number-of-push-messages
    |
    |*/

    public function push(string $date)
    {
        return $this->request->get('https://api.line.me/v2/bot/message/delivery/push?date=' . $date);
    }

    /*
    |
    | Get number of sent multicast messages
    | รับจำนวนข้อความมัลติคาสต์ที่ส่ง
    | https://developers.line.biz/en/reference/messaging-api/#get-number-of-multicast-messages
    |
    |*/

    public function multicast(string $date)
    {
        return $this->request->get('https://api.line.me/v2/bot/message/delivery/multicast?date=' . $date);
    }

    /*
    |
    | Get number of sent broadcast messages
    | รับจำนวนข้อความออกอากาศที่ส่ง
    | https://developers.line.biz/en/reference/messaging-api/#get-number-of-broadcast-messages
    |
    |*/

    public function broadcast(string $date)
    {
        return $this->request->get('https://api.line.me/v2/bot/message/delivery/broadcast?date=' . $date);
    }

}
