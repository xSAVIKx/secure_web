<?php

class DbOption
{

    private $mysql_conf_file;
    private $host;
    private $user;
    private $pswd;
    private $port;
    private $db_name;

    function __construct($mysql_conf_file = "mysql.ini")
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

    private $SELECT_USERS_FROM_DB = "SELECT * FROM users";

    function get_all_users()
    {
        $result_set = $this->connection->query($this->SELECT_USERS_FROM_DB);
        $user_list = new ArrayObject(array(), ArrayObject::STD_PROP_LIST);
        while ($user = $result_set->fetch_object("User")) {
            $user_list->append($user);
        }
        return $user_list;
    }
}