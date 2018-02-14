<?php

require_once(__DIR__ . '/vendor/autoload.php');

define('CONSUMER_KEY', '');
define('CONSUMER_SECRET', '');
define('ACCESS_TOKEN', '');
define('ACCESS_TOKEN_SECRET', '');

// package
// - Composer

use Abraham\TwitterOAuth\TwitterOAuth;

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
// アカウント情報の取得
// $content = $connection->get("account/verify_credentials");
// タイムラインから3件のツイートを取得
// $content = $connection->get("statuses/home_timeline", ['count' => 3]);
// 画像のアップロード
$media = $connection->upload("media/upload", [
  'media' => __DIR__ . '/test.jpg'
]);
// ツイート
$res = $connection->post("statuses/update", [
  'status' => 'これは画像付きテストツイートです',
  // 画像のidを指定
  'media_ids' => $media->media_id
]);

if ($connection->getLastHttpCode() === 200) {
  echo 'Success!' . PHP_EOL;
} else {
  echo 'Error!' . $res->errors[0]->message . PHP_EOL;
}
// var_dump($content);

?>
