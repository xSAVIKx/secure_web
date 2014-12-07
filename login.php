<?php
include_once('utils/include_dependencies.php');
include_once('utils/include_smarty.php');
$process_form = false;
$name = null;
$password = null;
$captcha_positive = false;
if (isset($_SESSION["captcha"]) && $_SESSION["captcha"] === $_POST["captcha"]) {
    $captcha_positive = true;
}
unset($_SESSION["captcha"]);
if ($captcha_positive && isset($_GET['name'], $_GET['password'])) {
    $name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_GET, 'password', FILTER_SANITIZE_STRING);
    $process_form = true;
} elseif ($captcha_positive && isset($_POST['name'], $_POST['password'])) {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);;
    $process_form = true;
}


if ($process_form && $captcha_positive) {
    $user_list = null;
    if (login($name, $password)) {
        $message[] = new Message("You have succesfully logged in", Message::INFO);
        $dbManager = new DbManager();
        $user_list = $dbManager->get_all_users();
        $smarty->assign('title', 'users');
        $smarty->assign('user_list', $user_list);
        set_redirect_header("index.php");
        $smarty->display('users.tpl');
    } else {
        $message[] = new Message("Invalid login or password", Message::WARNING);
        $smarty->assign('title', 'index');
        $smarty->assign('message', $message);
        $smarty->display('index.tpl');
    }
} else {

    if ($captcha_positive == false)
        $message[] = new Message("Invalid CAPTCHA. Try again please.", Message::ERROR);
    else
        $message[] = new Message("Something goes wrong", Message::WARNING);
    $smarty->assign('title', 'index');
    $smarty->assign('message', $message);
    $smarty->display('index.tpl');
}