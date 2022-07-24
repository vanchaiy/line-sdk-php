<?php

namespace LineSDK\Bot\Users;

use LineSDK\Curl\Request;

class Users
{
    public function __construct(string $channelAccessToken,)
    {
        $this->request = new Request([
            'Authorization: Bearer ' . $channelAccessToken,
        ]);
    }

    /*
    |
    | Get profile
    | รับโปรไฟล์
    | https://developers.line.biz/en/reference/messaging-api/#get-profile
    |
    |*/

    public function getProfile(string $userId)
    {
        return $this->request->get('https://api.line.me/v2/bot/profile/' . $userId);
    }

    /*
    |
    | Get a list of users who added your LINE Official Account as a friend
    | รับรายชื่อผู้ใช้ที่เพิ่มบัญชีทางการของคุณเป็นเพื่อน
    | https://developers.line.biz/en/reference/messaging-api/#get-follower-ids
    |
    | !!! This feature is available only for verified or premium accounts.
    |
    |*/

    public function membersIds(int $limit = 1000, string $start = '')
    {
        return $this->request->get('https://api.line.me/v2/bot/followers/ids', json_encode([
            "limit" => $limit,
            "start" => $start,
        ]));
    }

}
