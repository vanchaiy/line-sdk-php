<?php

require __DIR__ . '/vendor/autoload.php';

$lineBot = new LineSDK\Bot([
    "channelID" => "1655605564",
    "channelSecret" => "4be9dec0ed8e00faca1021f536d817f3",
    "channelAccessToken" => "BO1F1QkMf7H9nHtZ/DIUeLUpeqV8U5VOlfx31OeGJIC4IPb0HAU2JtfAwvrPxp68Aknk6avOSrkN3SgH8HqPGJPhpaSVEV50Y9NErudDFEMijezvV3wEWARj7qmCPUm2nSM8LZ+Xx3alEPuzR0pvNwdB04t89/1O/w1cDnyilFU=",
]);

$response = $lineBot->webhooks()->events();
if ($response) {
    $lineBot->reply($response->replyToken)->text(json_encode($response));
}
echo 'ready';


