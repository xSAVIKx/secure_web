<?php
/**
 * Created by PhpStorm.
 * User: iurii
 * Date: 06.10.14
 * Time: 10:20
 */
date_default_timezone_set("Europe/Kiev");

function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

include_once('User.php');
include_once('Site.php');
include_once('DbManager.php');
include_once('secure_session.php');

sec_session_start();