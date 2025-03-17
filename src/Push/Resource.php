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

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return $this->payload;
    }
}
