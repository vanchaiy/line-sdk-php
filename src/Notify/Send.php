<?php

namespace LineSDK\Notify;

use LineSDK\Curl\Request;
use LineSDK\Notify\Message;

class Send
{
    public function __construct(string $accessToken)
    {
        $this->message = new Message();
        $this->request = new Request([
            'content-type: multipart/form-data',
            'Authorization: Bearer ' . $accessToken,
        ]);
    }

    public function __call($method, $params)
    {
        return $this->curl(call_user_func_array(array($this->message, $method), $params));
    }

    public function curl($message)
    {
        return $this->request->post('https://notify-api.line.me/api/notify', $message);
    }
}
