<?php

namespace LineSDK\Bot\Webhooks;

use LineSDK\Curl\Request;

class Message
{

    public function __construct(string $channelAccessToken, object $events)
    {
        $this->channelAccessToken = $channelAccessToken;
        $this->events = $events;
    }

    // https://developers.line.biz/en/reference/messaging-api/#message-event

    /*
    |
    | Text
    | ข้อความ
    |
    |*/

    public function text()
    {
        return $this->find('text');
    }

    /*
    |
    | Image
    | ภาพ
    |
    |*/

    public function image()
    {
        return $this->find('image');
    }

    /*
    |
    | Video
    | วีดีโอ
    |
    |*/

    public function video()
    {
        return $this->find('video');
    }

    /*
    |
    | Audio
    | เสียง
    |
    |*/

    public function audio()
    {
        return $this->find('audio');
    }

    /*
    |
    | File
    | ไฟล์
    |
    |*/

    public function file()
    {
        return $this->find('file');
    }

    /*
    |
    | Location
    | สถานที่
    |
    |*/

    public function location()
    {
        return $this->find('location');
    }

    /*
    |
    | Sticker
    | สติ๊กเกอร์
    |
    |*/

    public function sticker()
    {
        return $this->find('sticker');
    }

    /*
    |
    | Get content
    | รับเนื้อหา
    | https://developers.line.biz/en/reference/messaging-api/#get-content
    |
    |*/

    public function content(string $messageId)
    {
        $request = new Request([
            'Authorization: Bearer ' . $this->channelAccessToken,
        ]);
        $response = $request->get('https://api-data.line.me/v2/bot/message/' . $messageId . '/content');
        return (object) [
            "name" => $messageId . "." . explode("/", $response->header["Content-Type"])[1],
            "file" => $response->body,
        ];
    }

    /*
    |
    |*/

    public function find(string $type)
    {
        if ($this->events && $this->events->message->type == $type) {
            return $this->events;
        }
    }
}
