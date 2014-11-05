<?php
include_once('utils/include_dependencies.php');
include_once('utils/include_smarty.php');
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'POST') {
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
        if ($dbManager->is_user_in_database($name)) {
            $message[] = new Message("User with such name already exists", Message::INFO);
            $smarty->assign('message', $message);
            $smarty->display('create_user.tpl');
        } else {
            $dbManager->add_user($name, $password);
            $message[] = new Message("You have successfully created new user", Message::SUCCESS);
            $smarty->assign('message', $message);
            $smarty->assign('title', 'Index page');
            set_redirect_header("index.php");
            $smarty->display('index.tpl');
        }
    }
}else{
    $smarty->assign('title', 'Create user');
    $smarty->display('create_user.tpl');
}