<?php
/**
 * Created by PhpStorm.
 * User: iurii
 * Date: 19.09.14
 * Time: 13:18
 */
include_once('utils/User.php');
include_once('utils/DbManager.php');

$name = $_GET['name'];
$password = $_GET['password'];
$dbManager = new DbManager();
$user = $dbManager->check_user($name, $password);
if ($user) {
    print "You have succesfully logged in as {$name}<br/>";
    print "Users in system:<br/>";
    $user_list = $dbManager->get_all_users();
    foreach ($user_list as $user) {
        print $user . "<br/>";
    }
} else {
    print "No user with given credentials was found";
}

