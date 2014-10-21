<?php
include_once("entity/Site.php");
include_once("entity/User.php");
include_once("DbOption.php");


/**
 * Created by PhpStorm.
 * User: iurii
 * Date: 19.09.14
 * Time: 13:21
 */
class DbManager
{
    protected $connection;
    protected $db_option;

    public function __construct()
    {
        $this->db_option = new DbOption();
        $this->connection = new mysqli($this->db_option->getHost(),
            $this->db_option->getUser(),
            $this->db_option->getPswd(),
            $this->db_option->getDbName(),
            $this->db_option->getPort());
    }

    private $SELECT_USERS_FROM_DB = "SELECT * FROM user";


    public function get_all_users()
    {
        $result_set = $this->connection->query($this->SELECT_USERS_FROM_DB);
        $user_list = null;
        if ($result_set) {
            $user_list = new ArrayObject(array(), ArrayObject::STD_PROP_LIST);
            while ($data = $result_set->fetch_assoc()) {
                $user = new User($data["id"], $data["name"], $data["password"]);
                $user_list->append($user);
            }
        }
        return $user_list;
    }

    private $SELECT_USER_BY_NAME = "SELECT id FROM user WHERE name=? LIMIT 1";

    public function is_user_in_database($name)
    {
        if ($name == null) {
            throw new InvalidArgumentException;
        }
        $pstmt = $this->connection->prepare($this->SELECT_USER_BY_NAME);
        $pstmt->bind_param("s", $this->connection->escape_string($name));
        $user = null;
        if ($pstmt->execute()) {
            $result_set = $pstmt->get_result();
            if ($result_set) {
                $data = $result_set->fetch_assoc();
                if ($data) {
                    return true;
                }
            }
        }
        return false;
    }

    private $SELECT_USER_BY_NAME_AND_PASSWORD = "SELECT id, name, password FROM user WHERE name=? AND password=? LIMIT 1";

    public function get_user_if_password_is_correct($name, $password)
    {
        if ($name == null || $password == null) {
            throw new InvalidArgumentException;
        }
        $password_hash = $this->get_password_hash($password);
        $pstmt = $this->connection->prepare($this->SELECT_USER_BY_NAME_AND_PASSWORD);
        $pstmt->bind_param("ss", $this->connection->escape_string($name), $this->connection->escape_string($password_hash));
        $user = null;
        if ($pstmt->execute()) {
            $result_set = $pstmt->get_result();
            if ($result_set) {
                $data = $result_set->fetch_assoc();
                if ($data) {
                    $user = new User($data["id"], $data["name"], $data["password"]);
                }
            }
        }
        return $user;
    }

    protected function get_password_hash($password)
    {
        return hash('sha512', $password);
    }

    public function get_user_by_id_if_password_is_correct($id, $password)
    {
        $user = $this->get_user_by_id($id);
        $password_hash = $this->get_password_hash($password);
        if ($user->getPassword() === $password_hash) {
            return $user;
        }
        return null;
    }

    private $SELECT_USER_BY_ID = "SELECT id, name, password FROM user WHERE id=?";

    public function get_user_by_id($id)
    {
        if ($id == null) {
            throw new InvalidArgumentException;
        }
        $pstmt = $this->connection->prepare($this->SELECT_USER_BY_ID);
        $pstmt->bind_param("s", $this->connection->escape_string($id));
        $user = null;
        if ($pstmt->execute()) {
            $result_set = $pstmt->get_result();
            if ($result_set) {
                $data = $result_set->fetch_assoc();
                $user = new User($data["id"], $data["name"], $data["password"]);
            }
        }
        return $user;
    }

    private $ADD_USER_TO_DB = "INSERT INTO user (name, password) VALUES(?, ?)";

    public function add_user($name, $password)
    {
        if ($name == null || $password == null) {
            throw new InvalidArgumentException;
        }
        $password_hash = $this->get_password_hash($password);
        $pstmt = $this->connection->prepare($this->ADD_USER_TO_DB);
        $pstmt->bind_param("ss", $this->connection->escape_string($name), $this->connection->escape_string($password_hash));
        return $pstmt->execute();
    }

    private $SELECT_SITES_FROM_DB = "SELECT * FROM site";

    public function get_all_websites()
    {
        $result_set = $this->connection->query($this->SELECT_SITES_FROM_DB);
        $web_site_list = null;

        if ($result_set) {
            $web_site_list = new ArrayObject(array(), ArrayObject::STD_PROP_LIST);
            while ($data = $result_set->fetch_assoc()) {
                $web_site = new Site($data["id"], $data["title"], $data["url"]);
                $web_site_list->append($web_site);
            }
        }
        return $web_site_list;
    }

    private $UPDATE_USER_INFO_BY_ID = "UPDATE user SET name=?, password=? WHERE id=?";

    public function update_user_info($id, $new_name, $new_password)
    {
        if ($id == null || $new_name == null || $new_password == null) {
            throw new InvalidArgumentException;
        }
        $password_hash = $this->get_password_hash($new_password);
        $pstmt = $this->connection->prepare($this->UPDATE_USER_INFO_BY_ID);
        $pstmt->bind_param("sss", $this->connection->escape_string($new_name), $this->connection->escape_string($password_hash), $this->connection->escape_string($id));
        return $pstmt->execute();
    }

    public function user_is_admin($id)
    {

    }

    private $DELETE_USER_BY_ID = "DELETE FROM user WHERE id=?";

    public function delete_user($id)
    {
        if ($id == null) {
            throw new InvalidArgumentException;
        }
        $pstmt = $this->connection->prepare($this->DELETE_USER_BY_ID);
        $pstmt->bind_param("s", $this->connection->escape_string($id));
        return $pstmt->execute();
    }


}