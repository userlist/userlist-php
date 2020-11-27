<?php
namespace Userlist\Push;

class Resource
{
    protected $payload;

    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    public function url()
    {
        $url = static::$url;
        $identifier = $this->payload['identifier'];

        return "$url/$identifier";
    }

    public function serialize()
    {
        return $this->payload;
    }
}
