<?php
/**
 * Created by PhpStorm.
 * User: iurii
 * Date: 06.10.14
 * Time: 13:26
 */

include_once('utils/include_dependencies.php');
include_once('utils/include_smarty.php');
logout();
$smarty->assign('title', 'Index page');
$smarty->display('index.tpl');