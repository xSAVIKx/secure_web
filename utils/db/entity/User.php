<?php
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

    function __toString()
    {
        return "User[name=$this->name, password=$this->password]";
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