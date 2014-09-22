<?php
/**
 * Created by PhpStorm.
 * User: iurii
 * Date: 22.09.14
 * Time: 15:32
 */
include_once('utils/User.php');
include_once('utils/DbManager.php');
$name = $_GET['name'];
$password = $_GET['password'];
$dbManager = new DbManager();
$user = $dbManager->check_user($name, $password);
if ($user) {
    print "User with such name={$name} already exists\n";
} else {
    $dbManager->add_user($name, $password);
    print "User '$name' successfullt created";
}