<?php
namespace Userlist\Push;

class Client
{
    private $client;
    private $config;

    public function __construct($config)
    {
        $this->config = $config;

        $options = array_merge($config->get('guzzle'), [
            'base_uri' => $config->get('push_endpoint')
        ]);

        $this->client = new \GuzzleHttp\Client($options);
    }

    public function get($endpoint)
    {
        return $this->request('GET', $endpoint);
    }

    public function put($endpoint, $payload = [])
    {
        return $this->request('PUT', $endpoint, $payload);
    }

    public function post($endpoint, $payload = [])
    {
        return $this->request('POST', $endpoint, $payload);
    }

    public function delete($endpoint, $payload = [])
    {
        return $this->request('DELETE', $endpoint, $payload);
    }

    private function request($method, $endpoint, $payload = [])
    {
        $options = [
            'body' => json_encode($payload),
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => "Push {$this->config->get('push_key')}",
                'Content-Type' => 'application/json; charset=UTF-8'
            ]
        ];

        return $this->client->request($method, $endpoint, $options);
    }
}
