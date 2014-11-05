<?php
date_default_timezone_set("Europe/Kiev");
include_once('db/DbManager.php');
include_once('secure_session.php');
include_once('Message.php');

function redirect($url, $status_code = 303)
{
    set_redirect_header($url, $status_code);
    die();
}

function set_redirect_header($url, $status_code = 303)
{
    header('Location: ' . $url, true, $status_code);
}