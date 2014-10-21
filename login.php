<?php
/**
 * Created by PhpStorm.
 * User: iurii
 * Date: 19.09.14
 * Time: 13:18
 */
include_once('utils/include_dependencies.php');
include_once('utils/include_smarty.php');
$process_form = false;
$name = null;
$password = null;
if (isset($_GET['name'], $_GET['password'])) {
    $name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_GET, 'password', FILTER_SANITIZE_STRING);
    $process_form = true;
} elseif (isset($_POST['name'], $_POST['password'])) {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);;
    $process_form = true;
}
if ($process_form == true) {
    if (login($name, $password)) {
        $dbManager = new DbManager();
        $user_list = $dbManager->get_all_users();
        $smarty->assign('title', 'users');
        $smarty->assign('user_list', $user_list);
        $smarty->display('users.tpl');
    } else {
        $message[] = new Message("Invalid login or password", Message::WARNING);
        $smarty->assign('title', 'index');
        $smarty->assign('message', $message);
        $smarty->display('index.tpl');
    }
} else {
    $message[] = new Message("Something goes wrong", Message::WARNING);
    $smarty->assign('title', 'index');
    $smarty->assign('message', $message);
    $smarty->display('index.tpl');
}