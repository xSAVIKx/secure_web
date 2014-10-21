<?php

/**
 * Created by PhpStorm.
 * User: iurii
 * Date: 21.10.14
 * Time: 18:00
 */
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