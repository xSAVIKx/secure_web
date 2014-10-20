<?php
/**
 * Created by PhpStorm.
 * User: iurii
 * Date: 22.09.14
 * Time: 15:32
 */
include_once('utils/include_dependencies.php');
include_once('utils/include_smarty.php');
$process_form = false;
$name = null;
$password = null;
if (isset($_GET['name'], $_GET['password'])) {
    $name = $_GET['name'];
    $password = $_GET['password'];
    $process_form = true;
} elseif (isset($_POST['name'], $_POST['password'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $process_form = true;
}
if ($process_form == true) {
    $dbManager = new DbManager();
    $user = $dbManager->check_user($name, $password);
    if ($user) {
        //TODO do user delete
        $message[] = new Message("User with such name already exists", Message::INFO);
        $smarty->assign('message', $message);
        $smarty->display('index.tpl');
    } else {
        //TODO show credentials
        $dbManager->add_user($name, $password);
        login($name, $password);
        $dbManager = new DbManager();
        $user_list = $dbManager->get_all_users();
        $smarty->assign('title', 'users');
        $smarty->assign('user_list', $user_list);
        $message[] = new Message("You have successfully signed up!", Message::SUCCESS);
        $smarty->assign('message', $message);
        $smarty->display('users.tpl');
    }
}