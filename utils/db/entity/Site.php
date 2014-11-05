<?php
class Site
{
    private $id;
    private $title;
    private $url;

    function __construct($id, $title, $url)
    {
        $this->id = $id;
        $this->title = $title;
        $this->url = $url;
    }

    function __toString()
    {
        return "Site[title=$this->title, url=$this->url]";
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }


}