<?php

namespace LineSDK\Bot\Message;

class MessageObjects
{
    public function text(string $text)
    {
        return [
            "type" => "text",
            "text" => $text,
        ];
    }

    public function sticker(int $packageId, int $stickerId)
    {
        return [
            "type" => "sticker",
            "packageId" => $packageId,
            "stickerId" => $stickerId,
        ];
    }

    public function image(string $originalContentUrl, string $previewImageUrl = '')
    {
        return [
            "type" => "image",
            "originalContentUrl" => $originalContentUrl,
            "previewImageUrl" => ($previewImageUrl ?? null) ? $previewImageUrl : $originalContentUrl,
        ];
    }

    public function video(string $originalContentUrl, string $previewImageUrl = '')
    {
        return [
            "type" => "video",
            "originalContentUrl" => $originalContentUrl,
            "previewImageUrl" => $previewImageUrl,
        ];
    }

    public function audio(string $originalContentUrl, int $duration)
    {
        return [
            "type" => "audio",
            "originalContentUrl" => $originalContentUrl,
            "duration" => $duration,
        ];
    }

    public function location(string $title, string $address, float $latitude, float $longitude)
    {
        return [
            "type" => "location",
            "title" => $title,
            "address" => $address,
            "latitude" => $latitude,
            "longitude" => $longitude,
        ];
    }

    public function json(string $textJson)
    {
        return json_decode($textJson, true);
    }

}
