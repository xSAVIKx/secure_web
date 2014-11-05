<?php
include_once("db/DbSessionManager.php");

class session implements SessionHandlerInterface
{
    private $salt = 'cH!swe!retReGu7W6bEDRup7usuDUh9THeD2CHeGE*ewr4n39=E@rAsp7c-Ph@pH';
    private $db;

    function __construct()
    {
        session_set_save_handler(array($this, 'open'), array($this, 'close'), array($this, 'read'), array($this, 'write'), array($this, 'destroy'), array($this, 'gc'));
        session_register_shutdown();
        $this->db = $db_manager = new DbSessionManager();
    }

    function __destruct()
    {
        session_write_close();
    }

    function start_session($session_name)
    {
        // Make sure the session cookie is not accessible via javascript.
        $httponly = true;

        // Hash algorithm to use for the sessionid. (use hash_algos() to get a list of available hashes.)
        $session_hash = 'sha512';
        $secure = false;
        // Check if hash is available
        if (in_array($session_hash, hash_algos())) {
            // Set the has function.
            ini_set('session.hash_function', $session_hash);
        }
        // How many bits per character of the hash.
        // The possible values are '4' (0-9, a-f), '5' (0-9, a-v), and '6' (0-9, a-z, A-Z, "-", ",").
        ini_set('session.hash_bits_per_character', 5);

        // Force the session to only use cookies, not URL variables.
        ini_set('session.use_only_cookies', 1);

        // Get session cookie parameters
        $cookieParams = session_get_cookie_params();
        // Set the parameters
        session_set_cookie_params($cookieParams["lifetime"],
            $cookieParams["path"],
            $cookieParams["domain"],
            $secure, $httponly);
        // Change the session name
        session_name($session_name);
        // Now we cat start the session
        session_start();
        // This line regenerates the session and delete the old one.
        // It also generates a new encryption key in the database.
        session_regenerate_id(true);
    }

    function read($id)
    {
        $data = $this->db->get_session_data_by_id($id);
        $key = $this->getkey($id);
        $data = $this->decrypt($data, $key);
        return $data;
    }

    function write($id, $data)
    {
        // Get unique key
        $key = $this->getkey($id);
        // Encrypt the data
        $data = $this->encrypt($data, $key);
        return $this->db->replace_session_data($id, $key, $data);
    }

    function destroy($id)
    {
        return $this->db->delete_session($id);
    }

    function gc($max)
    {
        return $this->db->delete_session_with_expired_time($max);
    }

    private function getkey($id)
    {
        if ($key = $this->db->get_session_key($id)) {
            return $key;
        } else {
            return hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
        }

    }

    private function encrypt($data, $key)
    {
        $key = substr(hash('sha256', $this->salt . $key . $this->salt), 0, 32);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $data, MCRYPT_MODE_ECB, $iv));
        return $encrypted;
    }

    private function decrypt($data, $key)
    {
        $key = substr(hash('sha256', $this->salt . $key . $this->salt), 0, 32);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($data), MCRYPT_MODE_ECB, $iv);
        return $decrypted;
    }

    public function close()
    {
        return true;
    }

    public function open($save_path, $session_id)
    {
        return true;
    }
}

function logout($redirect = true, $redirect_url = '../index.php')
{
    $_SESSION = [];
    $params = session_get_cookie_params();
    setcookie(session_name(),
        '', time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]);

    session_destroy();
    if ($redirect)
        header('Location: ' . $redirect_url);
}

function login($name, $password)
{
    $dbManager = new DbSessionManager();
    try {
        if ($dbManager->is_user_in_database($name)) {
            if ($user = $dbManager->get_user_if_password_is_correct($name, $password)) {
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
                    $user->getPassword() . $user_browser);
                // Login successful.
                return true;
            } else {
                return false;
            }
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
        $dbManager = new DbSessionManager();
        $user = $dbManager->get_user_by_id($user_id);
        if ($user) {
            $login_check = hash('sha512', $user->getPassword() . $user_browser);
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


$session = new session();
$session->start_session("s_");