<?php
namespace Userlist\Push;

class Message extends Resource
{
    public static $url = '/messages';

    public function __construct($payload)
    {
        if ($payload == null) {
            throw new \InvalidArgumentException('Missing required payload');
        }

        parent::__construct($payload);
    }
}
