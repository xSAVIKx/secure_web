<?php
/**
 * Created by PhpStorm.
 * User: iurii
 * Date: 06.10.14
 * Time: 13:00
 */
include_once("DbManager.php");
define("SECURE", false);

function sec_session_start()
{
    $session_name = "Session: " . uniqid();
    $httponly = true;
    $secure = SECURE;
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"],
        $cookieParams["domain"],
        $secure,
        $httponly);
    // Sets the session name to the one set above.
    session_name($session_name);
    session_start();            // Start the PHP session
    session_regenerate_id();    // regenerated the session, delete the old one.
}

function logout()
{
    $_SESSION = [];
    $params = session_get_cookie_params();
    setcookie(session_name(),
        '', time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]);

// Destroy session
    session_destroy();
    header('Location: ../index.php');
}

function login($name, $password)
{
    $dbManager = new DbManager();
    try {
        $user = $dbManager->check_user($name, $password);
        if ($user != null) {
            sec_session_start();
            // Password is correct!
            // Get the user-agent string of the user.
            $user_browser = $_SERVER['HTTP_USER_AGENT'];
            // XSS protection as we might print this value
            $user_id = preg_replace("/[^0-9]+/", "", $user->getId());
            $_SESSION['user_id'] = $user_id;
            // XSS protection as we might print this value
            $username = preg_replace("/[^a-zA-Z0-9_\-]+/",
                "",
                $user->getName());
            $_SESSION['username'] = $username;
            $_SESSION['login_string'] = hash('sha512',
                $password . $user_browser);
            // Login successful.
            return true;
        } else {
            return false;
        }
    } catch (InvalidArgumentException $e) {
        return false;
    }
}

function is_logged_in()
{
    if (isset($_SESSION['user_id'],
        $_SESSION['username'],
        $_SESSION['login_string'])) {
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];

        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];

        $dbManager = new DbManager();
        $user = $dbManager->get_user_by_id($user_id);
        if ($user) {
            $login_check = hash('sha512', $user->getPassword(), $user_browser);
            if ($login_check == $login_string) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
}