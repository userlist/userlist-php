<?php
namespace Userlist\Push;

class User extends Resource
{
    public static $url = '/users';

    public function __construct($payload)
    {
        if (is_string($payload)) {
            $payload = ['identifier' => $payload];
        }

        if ($payload == null) {
            throw new \InvalidArgumentException('Missing required payload');
        }

        if (!array_key_exists('identifier', $payload)) {
            throw new \InvalidArgumentException('Missing required parameter: identifier');
        }

        parent::__construct($payload);
    }
}
