<?php
namespace Userlist\Push;

final class Client {
  private $client;
  private $config;

  public function __construct($config) {
    $this->config = $config;

    $options = array_merge($config->get('guzzle'), [
      'base_uri' => $config->get('push_endpoint')
    ]);

    $this->client = new \GuzzleHttp\Client($options);
  }

  public function post($endpoint, $payload = []) {
    $this->request('POST', $endpoint, $payload);
  }

  private function request($method, $endpoint, $payload = []) {
    $options = [
      'body' => json_encode($payload),
      'headers' => [
        'Accept' => 'application/json',
        'Authorization' => "Push {$this->config->get('push_key')}",
        'Content-Type' => 'application/json; charset=UTF-8'
      ]
    ];

    $this->client->request($method, $endpoint, $options);
  }
}
