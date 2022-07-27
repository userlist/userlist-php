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

        parent::__construct($payload);
    }
}
