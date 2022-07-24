<?php

namespace LineSDK\Bot\Message;

use LineSDK\Bot\Message\MessageObjects;
use LineSDK\Curl\Request;

class BroadcastMessage
{
    public function __construct(string $channelAccessToken)
    {
        $this->message = new MessageObjects();
        $this->request = new Request([
            'content-type: application/json',
            'Authorization: Bearer ' . $channelAccessToken,
        ]);
    }

    public function __call($method, $params)
    {
        return $this->curl([call_user_func_array(array($this->message, $method) , $params)]);
    }

    public function json(string $textJson)
    {
        return $this->curl($this->message->json($textJson));

    }

    public function build($callback)
    {
        return $this->curl($callback($this->message));

    }

    public function curl(array $message)
    {
        $body = [
            "messages" => $message
        ];
        return $this->request->post('https://api.line.me/v2/bot/message/broadcast', json_encode($body));
    }
}
