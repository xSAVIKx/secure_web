<?php
/**
 * Created by PhpStorm.
 * User: iurii
 * Date: 22.09.14
 * Time: 15:32
 */
include_once('utils/include_dependencies.php');
include_once('utils/include_smarty.php');

$user_id = $_GET['user_id'];
$db = new DbManager();
$db->delete_user($user_id);
$message[] = new Message("User successfully deleted.", Message::SUCCESS);
$smarty->assign('message', $message);
$smarty->assign('title', 'Index page');
set_redirect_header("index.php");
$smarty->display('index.tpl');