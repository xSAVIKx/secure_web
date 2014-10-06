<?php
/**
 * Created by PhpStorm.
 * User: iurii
 * Date: 06.10.14
 * Time: 11:51
 */
include_once("utils/include_dependencies.php");
include_once("utils/include_smarty.php");
if (is_logged_in()) {
    $dbManager = new DbManager();
    $user_list = $dbManager->get_all_users();
    $smarty->assign('title', 'users');
    $smarty->assign('user_list', $user_list);
    $smarty->display('users.tpl');
} else {
    $smarty->assign('title', 'Index page');
    $smarty->display('index.tpl');
}