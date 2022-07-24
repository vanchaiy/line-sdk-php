<?php

namespace LineSDK\Notify;

class Message
{
    public function text(string $text)
    {
        return [
            'message' => $text,
        ];
    }

    public function sticker(string $text, int $stickerPackageId, int $stickerId)
    {
        return [
            'message' => $text,
            'stickerPackageId' => $stickerPackageId,
            'stickerId' => $stickerId,
        ];
    }

    public function image(string $text, string $originalContentUrl, string $previewImageUrl = '')
    {
        return [
            'message' => $text,
            'imageFullsize' => $originalContentUrl,
            'imageThumbnail' => ($previewImageUrl ?? null) ? $previewImageUrl : $originalContentUrl,
        ];
    }

    public function imageFile(string $text, string $imageFile)
    {
        return [
            'message' => $text,
            'imageFile' => new \CURLFile($imageFile),
        ];
    }

    public function multi(array $arrContent)
    {
        return $arrContent;
    }

}
