<?php
namespace Userlist\Push;

use JsonSerializable;

class Resource implements JsonSerializable
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

    public function jsonSerialize()
    {
        return $this->payload;
    }
}
