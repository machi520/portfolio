<!-- twitter APIの練習 -->

<?php

require_once './vendor/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;


// twitter APIを以下に設定します
$api_key='#';
$api_secret_key='#';
$access_token='#';
$access_token_secret='#';

$connection = new TwitterOAuth($api_key, $api_secret_key, $access_token, $access_token_secret);


$tweet_place = $connection->get("trends/place",array('id'=> '1117034'));

$trends[] = $tweet_place[0]->trends;
$namea = array();
foreach ($trends[0] as $value) {
    $names[] = $value->name;
}

?>