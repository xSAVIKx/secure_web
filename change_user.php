<?php
/**
 * Created by PhpStorm.
 * User: iurii
 * Date: 22.09.14
 * Time: 15:32
 */
include_once('utils/include_dependencies.php');
include_once('utils/include_smarty.php');
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'POST') {
    $process_form = false;
    $name = null;
    $old_password = null;
    $new_password = null;
    $user_id = null;
    if (isset($_POST['user_id'], $_POST['name'], $_POST['old_password'], $_POST['new_password'])) {
        $name = $_POST['name'];
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $user_id = $_POST['user_id'];
        $process_form = true;
    }
    if ($process_form == true) {
        $dbManager = new DbManager();
        if ($user = $dbManager->get_user_by_id_if_password_is_correct($user_id, $old_password)) {

            $dbManager->update_user_info($user->getId(), $name, $new_password);
            if ($_SESSION['username'] == $user->getName()) {
                login($name, $new_password);
            }
            $message[] = new Message("User info changed successfully.", Message::SUCCESS);
            $smarty->assign('message', $message);
            $smarty->assign('title', 'Index page');
            set_redirect_header("index.php");
            $smarty->display('index.tpl');
        } else {
            $message[] = new Message("Cannot change user info. Try again please.", Message::WARNING);
            $smarty->assign('user_id', $user_id);
            $smarty->assign('message', $message);
            $smarty->assign('title', 'Change user');
            $smarty->display('change_user.tpl');
        }
    } else {
        $message[] = new Message("Something goes wrong.", Message::WARNING);
        $smarty->assign('user_id', $user_id);
        $smarty->assign('message', $message);
        $smarty->assign('title', 'Change user');
        $smarty->display('change_user.tpl');
    }
} else {
    $user_id = $_GET['user_id'];
    $smarty->assign('user_id', $user_id);
    $smarty->assign('title', 'Change user');
    $smarty->display('change_user.tpl');
}