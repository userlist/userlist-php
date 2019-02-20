<?php
namespace Userlist;

class Push
{
    private $client;

    public function __construct($config = null)
    {
        $config = new Config($config);
        $this->client = new Push\Client($config);
    }

    public function user($payload = [])
    {
        if ($payload == null) {
            throw new \InvalidArgumentException('Missing required payload');
        }

        if (!array_key_exists('identifier', $payload)) {
            throw new \InvalidArgumentException('Missing required parameter: identifier');
        }

        $this->client->post('/users', $payload);
    }

    public function company($payload = [])
    {
        if ($payload == null) {
            throw new \InvalidArgumentException('Missing required payload');
        }

        if (!array_key_exists('identifier', $payload)) {
            throw new \InvalidArgumentException('Missing required parameter: identifier');
        }

        $this->client->post('/companies', $payload);
    }

    public function event($payload = [])
    {
        if ($payload == null) {
            throw new \InvalidArgumentException('Missing required payload');
        }

        if (!array_key_exists('name', $payload)) {
            throw new \InvalidArgumentException('Missing required parameter: name');
        }

        if (!array_key_exists('user', $payload)) {
            throw new \InvalidArgumentException('Missing required parameter: user');
        }

        $this->client->post('/events', $payload);
    }
}
