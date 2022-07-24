<?php

namespace LineSDK\Bot\Group;

use LineSDK\Curl\Request;

class Group
{
    public function __construct(string $channelAccessToken, string $groupId)
    {
        $this->groupId = $groupId;
        $this->request = new Request([
            'Authorization: Bearer ' . $channelAccessToken,
        ]);
    }

    /*
    |
    | Get group chat summary
    | รับข้อมูลสรุปการแชทเป็นกลุ่ม
    | https://developers.line.biz/en/reference/messaging-api/#get-group-summary
    |
    |*/

    public function summary()
    {
        return $this->request->get('https://api.line.me/v2/bot/group/' . $this->groupId . '/summary');
    }

    /*
    |
    | Get number of users in a group chat
    | รับจำนวนผู้ใช้ในการแชทเป็นกลุ่ม
    | https://developers.line.biz/en/reference/messaging-api/#get-members-group-count
    |
    |*/

    public function membersCount()
    {
        return $this->request->get('https://api.line.me/v2/bot/group/' . $this->groupId . '/members/count');
    }

    /*
    |
    | Get group chat member user IDs
    | รับ ID ผู้ใช้สมาชิกแชทกลุ่ม
    | https://developers.line.biz/en/reference/messaging-api/#get-group-member-user-ids
    |
    | !!! This feature is available only for verified or premium accounts.
    |
    |*/

    public function membersIds(string $continuationToken = '')
    {
        return $this->request->get('https://api.line.me/v2/bot/group/' . $this->groupId . '/members/ids?start=' . $continuationToken);
    }

    /*
    |
    | Get group chat member profile
    | รับโปรไฟล์สมาชิกแชทกลุ่ม
    | https://developers.line.biz/en/reference/messaging-api/#get-group-member-profile
    |
    |*/

    public function memberProfile(string $userId)
    {
        return $this->request->get('https://api.line.me/v2/bot/group/' . $this->groupId . '/member/' . $userId);
    }

    /*
    |
    | Leave group chat
    | ออกจากแชทกลุ่ม
    | https://developers.line.biz/en/reference/messaging-api/#leave-group
    |
    |*/

    public function leave()
    {
        return $this->request->post('https://api.line.me/v2/bot/group/' . $this->groupId . '/leave');
    }

}
