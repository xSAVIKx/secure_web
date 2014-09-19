<?php

/**
 * Created by PhpStorm.
 * User: iurii
 * Date: 19.09.14
 * Time: 13:52
 */
class User
{
    private $id;
    private $name;
    private $password;

    function __construct($id, $name, $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }


} 