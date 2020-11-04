<?php

//エスケープ

function e($string){
    return htmlspecialchars($string,ENT_QUOTES,'UTF-8');
}

function sanitize($before){
    foreach ($before as $key => $value) {
        $after[$key] = htmlspecialchars($value,ENT_QUOTES,'UTF-8');
    }
    return $after;
}

//トークン

function create_token(){
    $token = uniqid(dechex(random_int(0, 225)));
    return $token;
}

function insert_session($token){
    $_SESSION['token']= $token;
    return $_SESSION['token'];
}

function clear_session(){
    $_SESSION = array();

    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 60, '/');
    }
}

function token_catch(){
if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
    exit('不正なアクセスが行われました');
}}
// <input type="hidden" name="token" value=<?php print($token);

//PDO
$dsn = 'mysql:host=localhost;dbname=shop;charset=utf8';
$db_user = 'shop';
$db_pass = 'VPzflwAsJSXispHK';

?>