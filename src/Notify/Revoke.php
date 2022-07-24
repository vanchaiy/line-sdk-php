<?php

namespace LineSDK\Notify;

use LineSDK\Curl\Request;

class Revoke
{
    public function __construct(string $accessToken)
    {
        $this->request = new Request([
            'content-type: application/x-www-form-urlencoded',
            'Authorization: Bearer ' . $accessToken,
        ]);
    }

    public function go()
    {
        return $this->request->post('https://notify-api.line.me/api/revoke');
    }
}
