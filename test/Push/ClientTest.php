<?php
namespace Userlist\Test\Push;

use PHPUnit\Framework\TestCase;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

final class ClientTest extends TestCase
{
    private $mock;
    private $client;

    public function setUp(): void
    {
        $this->mock = new MockHandler();

        $config = new \Userlist\Config([
            'push_key' => 'some-push-key',
            'guzzle' => [
                'handler' => HandlerStack::create($this->mock)
            ]
        ]);

        $this->client = new \Userlist\Push\Client($config);
    }

    public function testSuccessfulGet()
    {
        $this->mock->append(new Response(200, ['Content-Length' => 0]));
        $this->client->get('/users');

        $lastRequest = $this->mock->getLastRequest();

        $this->assertEquals('GET', $lastRequest->getMethod());
        $this->assertEquals('https://push.userlist.com/users', (string) $lastRequest->getUri());
        $this->assertEquals('application/json', $lastRequest->getHeader('Accept')[0]);
        $this->assertEquals('application/json; charset=UTF-8', $lastRequest->getHeader('Content-Type')[0]);
        $this->assertEquals('Push some-push-key', $lastRequest->getHeader('Authorization')[0]);
    }

    public function testSuccessfulPut()
    {
        $this->mock->append(new Response(202, ['Content-Length' => 0]));
        $this->client->put('/users', ['identifier' => 'some-identifier']);

        $lastRequest = $this->mock->getLastRequest();

        $this->assertEquals('PUT', $lastRequest->getMethod());
        $this->assertEquals('https://push.userlist.com/users', (string) $lastRequest->getUri());
        $this->assertEquals('application/json', $lastRequest->getHeader('Accept')[0]);
        $this->assertEquals('application/json; charset=UTF-8', $lastRequest->getHeader('Content-Type')[0]);
        $this->assertEquals('Push some-push-key', $lastRequest->getHeader('Authorization')[0]);
        $this->assertEquals('{"identifier":"some-identifier"}', (string) $lastRequest->getBody());
    }

    public function testSuccessfulPost()
    {
        $this->mock->append(new Response(202, ['Content-Length' => 0]));
        $this->client->post('/users', ['identifier' => 'some-identifier']);

        $lastRequest = $this->mock->getLastRequest();

        $this->assertEquals('POST', $lastRequest->getMethod());
        $this->assertEquals('https://push.userlist.com/users', (string) $lastRequest->getUri());
        $this->assertEquals('application/json', $lastRequest->getHeader('Accept')[0]);
        $this->assertEquals('application/json; charset=UTF-8', $lastRequest->getHeader('Content-Type')[0]);
        $this->assertEquals('Push some-push-key', $lastRequest->getHeader('Authorization')[0]);
        $this->assertEquals('{"identifier":"some-identifier"}', (string) $lastRequest->getBody());
    }

    public function testSuccessfulDelete()
    {
        $this->mock->append(new Response(202, ['Content-Length' => 0]));
        $this->client->delete('/users', ['identifier' => 'some-identifier']);

        $lastRequest = $this->mock->getLastRequest();

        $this->assertEquals('DELETE', $lastRequest->getMethod());
        $this->assertEquals('https://push.userlist.com/users', (string) $lastRequest->getUri());
        $this->assertEquals('application/json', $lastRequest->getHeader('Accept')[0]);
        $this->assertEquals('application/json; charset=UTF-8', $lastRequest->getHeader('Content-Type')[0]);
        $this->assertEquals('Push some-push-key', $lastRequest->getHeader('Authorization')[0]);
        $this->assertEquals('{"identifier":"some-identifier"}', (string) $lastRequest->getBody());
    }
}
