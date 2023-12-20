<?php

namespace LineSDK\Bot\Webhooks;

use LineSDK\Bot\Webhooks\Message;
use LineSDK\Curl\Request;

class Webhooks
{
    public function __construct(string $channelAccessToken)
    {
        $this->channelAccessToken = $channelAccessToken;
        $this->content = file_get_contents('php://input');
        $this->events = json_decode($this->content);
        
        $this->request = new Request([
            'Content-Type: application/json',
            'Authorization: Bearer ' . $channelAccessToken,
        ]);
    }

    /*
    |
    | Message event
    |
    |*/

    public function message()
    {
        return new Message($this->channelAccessToken, $this->events());
    }

    /*
    |
    | Message event
    | เหตุการณ์ข้อความ
    | https://developers.line.biz/en/reference/messaging-api/#message-event
    |
    |*/

    public function events()
    {
        if (!is_null($this->events->events ?? null)) {
            return $this->events->events;
        } else {
            return [];
        }
    }

    /*
    |
    | Unsend event
    | ยกเลิกการส่งเหตุการณ์
    | https://developers.line.biz/en/reference/messaging-api/#unsend-event
    |
    |*/

    public function unsend()
    {
        return $this->find('unsend');
    }

    /*
    |
    | Follow event
    | ติดตามกิจกรรม
    | https://developers.line.biz/en/reference/messaging-api/#follow-event
    |
    |*/

    public function follow()
    {
        return $this->find('follow');
    }

    /*
    |
    | Unfollow event
    | เลิกติดตามเหตุการณ์
    | https://developers.line.biz/en/reference/messaging-api/#unfollow-event
    |
    |*/

    public function unfollow()
    {
        return $this->find('unfollow');
    }

    /*
    |
    | Join event
    | บอตเข้าร่วมกล่ม
    | https://developers.line.biz/en/reference/messaging-api/#join-event
    |
    |*/

    public function join()
    {
        return $this->find('join');
    }

    /*
    |
    | Leave event
    | บอตออกจากกลุ่ม
    | https://developers.line.biz/en/reference/messaging-api/#leave-event
    |
    |*/

    public function leave()
    {
        return $this->find('leave');
    }

    /*
    |
    | Member join event
    | สมาชิกเข้าร่วมกลุ่ม
    | https://developers.line.biz/en/reference/messaging-api/#member-joined-event
    |
    |*/

    public function memberJoined()
    {
        return $this->find('memberJoined');
    }

    /*
    |
    | Member leave event
    | สมาชิกออกจากกลุ่ม
    | https://developers.line.biz/en/reference/messaging-api/#member-left-event
    |
    |*/

    public function memberLeft()
    {
        return $this->find('memberLeft');
    }

    /*
    |
    | Postback event
    | เหตุการณ์ย้อนหลัง
    | https://developers.line.biz/en/reference/messaging-api/#postback-event
    |
    |*/

    public function postback()
    {
        return $this->find('postback');
    }

    /*
    |
    | Video viewing complete event
    | รับชมวีดีทัศน์ครบจบกิจกรรม
    | https://developers.line.biz/en/reference/messaging-api/#postback-event
    |
    |*/

    public function videoPlayComplete()
    {
        return $this->find('videoPlayComplete');
    }

    /*
    |
    | Beacon event
    | บีคอนเหตุการณ์
    | https://developers.line.biz/en/reference/messaging-api/#beacon-event
    |
    |*/

    public function beacon()
    {
        return $this->find('beacon');
    }

    /*
    |
    | Account link event
    | กิจกรรมเชื่อมโยงบัญชี
    | https://developers.line.biz/en/reference/messaging-api/#account-link-event
    |
    |*/

    public function accountLink()
    {
        return $this->find('accountLink');
    }

    /*
    |
    | Device link event
    | เหตุการณ์การลิงก์อุปกรณ์
    | https://developers.line.biz/en/reference/messaging-api/#device-link-event
    |
    |*/

    public function thingsLink()
    {
        $event = $this->find('things');
        if ($event->things->type == 'link') {
            return $event;
        }
    }

    /*
    |
    | Device unlink event
    | กิจกรรมยกเลิกการลิงก์อุปกรณ์
    | https://developers.line.biz/en/reference/messaging-api/#device-unlink-event
    |
    |*/

    public function thingsUnlink()
    {
        $event = $this->find('things');
        if ($event->things->type == 'unlink') {
            return $event;
        }
    }

    /*
    |
    | LINE Things scenario execution event
    | LINE Things เหตุการณ์การดำเนินการสถานการณ์
    | https://developers.line.biz/en/reference/messaging-api/#device-unlink-event
    |
    |*/

    public function things()
    {
        return $this->find('things');
    }

    /*
    |
    | Set webhook endpoint URL
    | ตั้งค่า URL ปลายทางของเว็บฮุค
    | https://developers.line.biz/en/reference/messaging-api/#set-webhook-endpoint-url
    |
    |*/

    public function setEndoint(string $url)
    {
        return $this->request->put('https://api.line.me/v2/bot/channel/webhook/endpoint', json_encode(["endpoint" => $url]));
    }

    /*
    |
    | Get webhook endpoint information
    | รับข้อมูลปลายทางของเว็บฮุค
    | https://developers.line.biz/en/reference/messaging-api/#get-webhook-endpoint-information
    |
    |*/

    public function getEndoint()
    {
        return $this->request->get('https://api.line.me/v2/bot/channel/webhook/endpoint');
    }

    /*
    |
    | Get webhook endpoint information
    | รับข้อมูลปลายทางของเว็บฮุค
    | https://developers.line.biz/en/reference/messaging-api/#get-webhook-endpoint-information
    |
    |*/

    public function testEndoint()
    {
        return $this->request->post('https://api.line.me/v2/bot/channel/webhook/test');
    }

    /*
    |
    | Evnt on Group
    | กิจกรรมบน Group
    |
    |*/

    public function isGroup()
    {
        return $this->findSource('group');
    }

    /*
    |
    | Evnt on Room
    | กิจกรรมบน Room
    |
    |*/

    public function isRoom()
    {
        return $this->findSource('room');
    }

    /*
    |
    | Evnt on User
    | กิจกรรมตัวต่อตัว
    |
    |*/

    public function isUser()
    {
        return $this->findSource('user');
    }

    /*
    |
    |*/

    public function find(string $type)
    {
        $event = $this->events();
        if ($event && $event->type == $type) {
            return $event;
        }
    }

    /*
    |
    |*/

    public function findSource(string $type)
    {
        $event = $this->events();
        if ($event && $event->source->type == $type) {
            return $event;
        }
    }

}
