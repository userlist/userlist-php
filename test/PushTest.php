<?php
namespace Userlist\Test;

use PHPUnit\Framework\TestCase;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

final class PushTest extends TestCase
{
    protected $push;
    protected $mock;

    public function setUp(): void
    {
        $this->mock = new MockHandler();

        $config = new \Userlist\Config([
            'push_key' => 'some-push-key',
            'guzzle' => [
                'handler' => HandlerStack::create($this->mock)
            ]
        ]);

        $this->push = new \Userlist\Push($config);
    }

    public function testUserSuccessful()
    {
        $this->mock->append(new Response(202, ['Content-Length' => 0]));
        $this->push->user(['identifier' => 'some-identifier']);
        $this->assertEquals('/users', $this->mock->getLastRequest()->getUri()->getPath());
    }

    public function testCompanySuccessful()
    {
        $this->mock->append(new Response(202, ['Content-Length' => 0]));
        $this->push->company(['identifier' => 'some-identifier']);
        $this->assertEquals('/companies', $this->mock->getLastRequest()->getUri()->getPath());
    }

    public function testRelationshipSuccessful()
    {
        $this->mock->append(new Response(202, ['Content-Length' => 0]));
        $this->push->relationship(['user' => 'user-1', 'company' => 'company-1']);
        $this->assertEquals('/relationships', $this->mock->getLastRequest()->getUri()->getPath());
    }

    public function testEventSuccessful()
    {
        $this->mock->append(new Response(202, ['Content-Length' => 0]));
        $this->push->event(['name' => 'some-event', 'user' => 'some-identifier']);
        $this->assertEquals('/events', $this->mock->getLastRequest()->getUri()->getPath());
    }
}
