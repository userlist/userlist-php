<?php
namespace Userlist\Push;

class Relationship extends Resource
{
    public static $url = '/relationships';

    public function __construct($payload)
    {
        if ($payload == null) {
            throw new \InvalidArgumentException('Missing required payload');
        }

        if (!array_key_exists('user', $payload)) {
            throw new \InvalidArgumentException('Missing required parameter: user');
        }

        if (!array_key_exists('company', $payload)) {
            throw new \InvalidArgumentException('Missing required parameter: company');
        }

        parent::__construct($payload);
    }
}
