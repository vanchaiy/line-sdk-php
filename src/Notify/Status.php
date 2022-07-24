<?php

namespace LineSDK\Notify;

use LineSDK\Curl\Request;

class Status
{
    public function __construct($accessToken)
    {
        $this->request = new Request([
            'content-type: application/json',
            'Authorization: Bearer ' . $accessToken,
        ]);
    }

    public function go()
    {
        return $this->request->get('https://notify-api.line.me/api/status');
    }
}
