# Messaging API / Bot

https://developers.line.biz/en/docs/messaging-api/


## Message

https://developers.line.biz/en/reference/messaging-api/#messages

### Send message

```php

$response = LineBot::reply(<replyToken>)-><MessageObjects>

$response = LineBot::push(<userId>)->-><MessageObjects>

$response = LineBot::multicast([<userId>,<userId>,...])-><MessageObjects>

$response = LineBot::broadcast()-><MessageObjects>

```

### Message objects in Send

https://developers.line.biz/en/reference/messaging-api/#message-objects

```php

->text(<text>);

->sticker(<packageId>, <stickerId>);

->image(<originalContentUrl>); OR ->image(<originalContentUrl>, <previewImageUrl>);

->video(<originalContentUrl>, <duration>);

->location(<title>, <address>, <latitude>, <longitude>);

->json(<textJson>);

->build(<function>);

```

### Get message

```php

$response = LineBot::message()->quota();

$response = LineBot::message()->consumption();

$response = LineBot::message()->reply(<date>);

$response = LineBot::message()->push(<date>);

$response = LineBot::message()->multicast(<date>);

$response = LineBot::message()->multicast(<date>);

```


## Webhooks

### Webhook Event Objects

https://developers.line.biz/en/reference/messaging-api/#webhook-event-objects

```php

$response = LineBot::webhooks()->events();

$response = LineBot::webhooks()->unsend();

$response = LineBot::webhooks()->follow();

$response = LineBot::webhooks()->unfollow();

$response = LineBot::webhooks()->join();

$response = LineBot::webhooks()->leave();

$response = LineBot::webhooks()->memberJoined();

$response = LineBot::webhooks()->memberLeft();

$response = LineBot::webhooks()->postback();

$response = LineBot::webhooks()->videoPlayComplete();

$response = LineBot::webhooks()->beacon();

$response = LineBot::webhooks()->accountLink();

$response = LineBot::webhooks()->thingsLink();

$response = LineBot::webhooks()->thingsUnlink();

$response = LineBot::webhooks()->things();

$response = LineBot::webhooks()->isGroup();

$response = LineBot::webhooks()->isRoom();

$response = LineBot::webhooks()->isUser();


```

### Webhook settings

https://developers.line.biz/en/reference/messaging-api/#webhook-settings

```php

$response = LineBot::webhooks()->setEndoint(<URL>);

$response = LineBot::webhooks()->getEndoint();

$response = LineBot::webhooks()->testEndoint();

```

### Webhook Message Event

https://developers.line.biz/en/reference/messaging-api/#message-event

```php

$response = LineBot::webhooks()->message()->find(<text|image|video|audio|file|location|sticker>);

$response = LineBot::webhooks()->message()->text();

$response = LineBot::webhooks()->message()->image();

$response = LineBot::webhooks()->message()->video();

$response = LineBot::webhooks()->message()->audio();

$response = LineBot::webhooks()->message()->file();

$response = LineBot::webhooks()->message()->location();

$response = LineBot::webhooks()->message()->sticker();

```

## Channel access token

https://developers.line.biz/en/reference/messaging-api/#channel-access-token

```php


$response = LineBot::oauth()->accessToken();

$response = LineBot::oauth()->verify();

$response = LineBot::oauth()->revoke();


```


## Group chats

https://developers.line.biz/en/reference/messaging-api/#group

```php


$response = LineBot::group(<groupId>)->summary();

$response = LineBot::group(<groupId>)->membersCount();

$response = LineBot::group(<groupId>)->membersIds(<continuationToken : optional>);

$response = LineBot::group(<groupId>)->memberProfile(<userId>);

$response = LineBot::group(<groupId>)->leave();

```

## Multi-person chats (Room)

https://developers.line.biz/en/reference/messaging-api/#chat-room

```php


$response = LineBot::room(<roomId>)->membersCount();

$response = LineBot::room(<roomId>)->membersIds(<continuationToken : optional>);

$response = LineBot::room(<roomId>)->memberProfile(<userId>);

$response = LineBot::room(<roomId>)->leave();

```

## Insight

https://developers.line.biz/en/reference/messaging-api/#get-insight

```php


$response = LineBot::insight()->messageDelivery(<date>);

$response = LineBot::insight()->followers(<date>);

$response = LineBot::insight()->getFriend();

$response = LineBot::insight()->statistics(<requestId>);


```


## Users

https://developers.line.biz/en/reference/messaging-api/#users

```php


$response = LineBot::users()->getProfile(<userId>);

$response = LineBot::users()->membersIds(<limit : optional> , <start : optional>);

```


## Notes

Emoji Unicode : https://apps.timwhitlock.info/emoji/tables/unicode

## Sample

### Bot

- [Pure PHP](sample/purephpbot.md)
- [Laravel](sample/laravelbot.md)

### Webhooks

- [Pure PHP](sample/purephpwebhooks.md)
- [Laravel](sample/laravelwebhooks.md)