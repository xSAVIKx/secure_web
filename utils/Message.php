<?php

class Message implements JsonSerializable
{
    private $messageTag;
    private $message;

    const INFO = "info";
    const WARNING = "warning";
    const ERROR = "error";
    const SUCCESS = "success";

    function __construct($message, $messageTag)
    {
        $this->message = $message;
        $this->messageTag = $messageTag;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getMessageTag()
    {
        return $this->messageTag;
    }

    function jsonSerialize()
    {
        return [
            'message' => $this->getMessage(),
            'messageTag' => $this->getMessageTag(),
        ];
    }
}

$message = array();