<?php

namespace LineSDK\Bot\Oauth;

use LineSDK\Curl\Request;

class Oauth
{
    public function __construct(string $channelID, string $channelSecret, string $channelAccessToken)
    {
        $this->channelID = $channelID;
        $this->channelSecret = $channelSecret;
        $this->channelAccessToken = $channelAccessToken;

        $this->request = new Request([
            'content-type: application/x-www-form-urlencoded',
        ]);
    }

    /*
    |
    | Issue short-lived channel access token
    | ออกโทเค็นการเข้าถึงช่องอายุสั้น
    | https://developers.line.biz/en/reference/messaging-api/#issue-shortlived-channel-access-token
    |
    |*/

    public function accessToken()
    {
        return $this->request->post('https://api.line.me/v2/oauth/accessToken', 'grant_type=client_credentials&client_id=' . $this->channelID . '&client_secret=' . $this->channelSecret);
    }

    /*
    |
    | Verify the validity of short-lived and long-lived channel access tokens
    | ตรวจสอบความถูกต้องของโทเค็นการเข้าถึงช่องที่มีอายุสั้นและยาวนาน
    | https://developers.line.biz/en/reference/messaging-api/#verfiy-channel-access-token
    |
    |*/

    public function verify(string $access_token)
    {
        return $this->request->post('https://api.line.me/v2/oauth/verify', 'access_token=' . $access_token);
    }

    /*
    |
    | Revoke short-lived or long-lived channel access token
    | เพิกถอนโทเค็นการเข้าถึงช่องอายุสั้นหรืออายุยืน
    | https://developers.line.biz/en/reference/messaging-api/#verfiy-channel-access-token
    |
    |*/

    public function revoke(string $access_token)
    {
        return $this->request->post('https://api.line.me/v2/oauth/revoke', 'access_token=' . $access_token);
    }

}
