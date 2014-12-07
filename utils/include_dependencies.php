<?php
date_default_timezone_set("Europe/Kiev");
include_once('db/DbManager.php');
include_once('secure_session.php');
include_once('Message.php');

header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");

function redirect($url, $status_code = 303)
{
    set_redirect_header($url, $status_code);
    die();
}

function set_redirect_header($url, $status_code = 303)
{
    header('Location: ' . $url, true, $status_code);
}