<?php
include_once("Site.php");
include_once("User.php");

class DbOption
{

    private $mysql_conf_file;
    private $host;
    private $user;
    private $pswd;
    private $port;
    private $db_name;

    function __construct($mysql_conf_file = "/home/iurii/PhpstormProjects/secure_web/mysql.ini")
    {
        $this->mysql_conf_file = $mysql_conf_file;
        $mysql_options = parse_ini_file($this->mysql_conf_file);
        $this->host = $mysql_options['host'];
        $this->user = $mysql_options['user'];
        $this->pswd = $mysql_options['password'];
        $this->port = $mysql_options['port'];
        $this->db_name = $mysql_options['db'];
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getDbName()
    {
        return $this->db_name;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return mixed
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @return mixed
     */
    public function getPswd()
    {
        return $this->pswd;
    }


}

/**
 * Created by PhpStorm.
 * User: iurii
 * Date: 19.09.14
 * Time: 13:21
 */
class DbManager
{
    private $connection;
    private $db_option;

    function __construct()
    {
        $this->db_option = new DbOption();
        $this->connection = new mysqli($this->db_option->getHost(),
            $this->db_option->getUser(),
            $this->db_option->getPswd(),
            $this->db_option->getDbName(),
            $this->db_option->getPort());
    }

    private $SELECT_USERS_FROM_DB = "SELECT * FROM user";


    function get_all_users()
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

    private $SELECT_USER_BY_NAME_AND_PASSWORD = "SELECT id, name, password FROM user WHERE name=? AND password=? LIMIT 1";

    function check_user($name, $password)
    {
        if ($name == null || $password == null) {
            throw new InvalidArgumentException;
        }
        $pstmt = $this->connection->prepare($this->SELECT_USER_BY_NAME_AND_PASSWORD);
        $pstmt->bind_param("ss", $this->connection->escape_string($name), $this->connection->escape_string($password));
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

    private $SELECT_USER_BY_ID = "SELECT id, name, password FROM user WHERE id=?";

    function get_user_by_id($id)
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

    function add_user($name, $password)
    {
        if ($name == null || $password == null) {
            throw new InvalidArgumentException;
        }
        $pstmt = $this->connection->prepare($this->ADD_USER_TO_DB);
        $pstmt->bind_param("ss", $this->connection->escape_string($name), $this->connection->escape_string($password));
        return $pstmt->execute();
    }

    private $SELECT_SITES_FROM_DB = "SELECT * FROM site";

    function get_all_websites()
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
}