<?php
namespace Userlist\Push;

class Event extends Resource
{
    public static $url = '/events';

    public function __construct($payload)
    {
        if ($payload == null) {
            throw new \InvalidArgumentException('Missing required payload');
        }

        if (!array_key_exists('name', $payload)) {
            throw new \InvalidArgumentException('Missing required parameter: name');
        }

        if (!array_key_exists('user', $payload) && !array_key_exists('company', $payload)) {
            throw new \InvalidArgumentException('Missing required parameter: user or company');
        }

        parent::__construct($payload);
    }

    public function url() {
        return null;
    }
}
