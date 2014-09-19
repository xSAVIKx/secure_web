<?php
/**
 * Created by PhpStorm.
 * User: iurii
 * Date: 19.09.14
 * Time: 13:18
 */

$name = $_GET['name'];
$password = $_GET['password'];

$dbManager = new DbManager();
$user_list = $dbManager->get_all_users();
foreach ($user_list as $user){

}