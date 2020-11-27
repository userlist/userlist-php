<?php
namespace Userlist\Push;

class Company extends Resource
{
    public static $url = '/companies';

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
