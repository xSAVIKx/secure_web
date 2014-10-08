<?php
/**
 * Created by PhpStorm.
 * User: iurii
 * Date: 19.09.14
 * Time: 13:18
 */
include_once('utils/include_dependencies.php');
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
    if (login($name, $password)) {
        $dbManager = new DbManager();
        $user_list = $dbManager->get_all_users();
        print "<a href='/logout.php'>logout</a><br/>";

        print "
        <h5>Users in system:</h5>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Password</th>
        </tr>
        </thead>
        <tbody>";
        foreach ($user_list as $user) {
            print "<tr>
                <td>
            {$user->getId()}</td>
                <td>
            {$user->getName()}</td>
                <td>
            {$user->getPassword()}</td>
            </tr>";
        }
        print "
        </tbody>
    </table>";
    } else {
        print "Wrong username or password";
    }
}