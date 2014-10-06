<?php
/**
 * Created by PhpStorm.
 * User: iurii
 * Date: 19.09.14
 * Time: 13:18
 */
include_once('utils/include_dependencies.php');
include_once('utils/include_smarty.php');

if (isset($_GET['name'], $_GET['password']) || isset($_POST['name'], $_POST['password'])) {
    $name = $_GET['name'];
    $password = $_GET['password'];
    if (login($name, $password)) {
        sec_session_start();
        $dbManager = new DbManager();
        $user_list = $dbManager->get_all_users();
        $smarty->assign('title', 'users');
        $smarty->assign('user_list', $user_list);
        $smarty->display('users.tpl');
    } else {
        $message[] = (new Message("Invalid login or password", Message::WARNING));
        add_message($message);
        $smarty->assign('title', 'index');
        $smarty->assign('message', $message);
        $smarty->display('index.tpl');
    }
}