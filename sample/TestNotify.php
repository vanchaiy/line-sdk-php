
<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    require __DIR__ . '/vendor/autoload.php';

    $response = '';
    $lineNotify = new LineSDK\Notify('Fs2RWGHjr....aSD0SDxGj');

    switch ($_GET['go'] ?? null) {
        case 'sendtext':
            $response = $lineNotify->send()->text('Hello LineNotify');
            break;
        case 'sendsticker':
            $response = $lineNotify->send()->sticker('Hello sticker', 1, 1);
            break;
        case 'sendimage':
            $response = $lineNotify->send()->image('Hello image', 'https://github.githubassets.com/images/modules/logos_page/Octocat.png');
            break;
        case 'sendimagefile':
            $response = $lineNotify->send()->imageFile('Hello imageFile', dirname(__FILE__) . '\vendor\vanchaiy\line-sdk-php\test\demo.jpg');
            break;
        case 'sendmulti':
            $response = $lineNotify->send()->multi([
                'message' => 'Hello multi message',
                'stickerPackageId' => 1,
                'stickerId' => 1,
                'imageFullsize' => 'https://github.githubassets.com/images/modules/logos_page/Octocat.png',
                'imageThumbnail' => 'https://github.githubassets.com/images/modules/logos_page/Octocat.png',
                'imageFile' => new \CURLFile(dirname(__FILE__) . '\vendor\vanchaiy\line-sdk-php\test\demo.jpg'),
            ]);
            break;
        case 'status':
            $response = $lineNotify->status();
            break;
        case 'revoke':
            $response = $lineNotify->revoke();
            break;
    }

?>

<!DOCTYPE html>
<html>
    <body>
        <h1>Test LINE Notify</h1>
        <p>send message</p>
        <ol>
            <li><a href="?go=sendtext">send text</a></li>
            <li><a href="?go=sendsticker">send sticker</a></li>
            <li><a href="?go=sendimage">send image</a></li>
            <li><a href="?go=sendimagefile">send imageFile</a></li>
            <li><a href="?go=sendmulti">send multi</a></li>
        </ol>
        <p>other</p>
        <ul>
            <li><a href="?go=status">get status</a></li>
            <li><a href="?go=revoke">revoke</a></li>
        </ul>
        <p>response</p>
        <p> <?php print_r($response) ?> </p>
    </body>
</html>
