<?php

namespace LineSDK\Bot\Room;

use LineSDK\Curl\Request;

class Room
{
    public function __construct(string $channelAccessToken, string $roomId)
    {
        $this->roomId = $roomId;
        $this->request = new Request([
            'Authorization: Bearer ' . $channelAccessToken,
        ]);
    }


    /*
    |
    | Get number of users in a multi-person chat
    | รับจำนวนผู้ใช้ในการแชทหลายคน
    | https://developers.line.biz/en/reference/messaging-api/#get-members-room-count
    |
    |*/

    public function membersCount()
    {
        return $this->request->get('https://api.line.me/v2/bot/room/' . $this->roomId . '/members/count');
    }

    /*
    |
    | Get multi-person chat member user IDs
    | รับ ID ผู้ใช้สมาชิกแชทหลายคน
    | https://developers.line.biz/en/reference/messaging-api/#get-room-member-user-ids
    |
    | !!! This feature is available only for verified or premium accounts.
    |
    |*/

    public function membersIds(string $continuationToken = '')
    {
        return $this->request->get('https://api.line.me/v2/bot/room/' . $this->roomId . '/members/ids?start=' . $continuationToken);
    }

    /*
    |
    | Get multi-person chat member profile
    | รับโปรไฟล์สมาชิกแชทหลายคน
    | https://developers.line.biz/en/reference/messaging-api/#get-room-member-profile
    |
    |*/

    public function memberProfile(string $userId)
    {
        return $this->request->get('https://api.line.me/v2/bot/room/' . $this->roomId . '/member/' . $userId);
    }

    /*
    |
    | Leave multi-person chat
    | ออกจากการแชทหลายคน
    | https://developers.line.biz/en/reference/messaging-api/#leave-room
    |
    |*/

    public function leave()
    {
        return $this->request->post('https://api.line.me/v2/bot/room/' . $this->roomId . '/leave');
    }

}
