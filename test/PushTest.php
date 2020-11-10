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

    public function testUserMissingPayload()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Missing required payload');
        $this->push->user(null);
    }

    public function testUserMissingIdentifier()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Missing required parameter: identifier');
        $this->push->user(['email' => 'test@example.com']);
    }

    public function testUserSuccessful()
    {
        $this->mock->append(new Response(202, ['Content-Length' => 0]));
        $this->push->user(['identifier' => 'some-identifier']);
        $this->assertEquals('/users', $this->mock->getLastRequest()->getUri()->getPath());
    }

    public function testCompanyMissingPayload()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Missing required payload');
        $this->push->company(null);
    }

    public function testCompanyMissingIdentifier()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Missing required parameter: identifier');
        $this->push->company(['name' => 'Evil Corp']);
    }

    public function testCompanySuccessful()
    {
        $this->mock->append(new Response(202, ['Content-Length' => 0]));
        $this->push->company(['identifier' => 'some-identifier']);
        $this->assertEquals('/companies', $this->mock->getLastRequest()->getUri()->getPath());
    }

    public function testEventMissingPayload()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Missing required payload');
        $this->push->event(null);
    }

    public function testEventMissingName()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Missing required parameter: name');
        $this->push->event(['user' => 'identifier']);
    }

    public function testEventMissingUserAndCompany()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Missing required parameter: user or company');
        $this->push->event(['name' => 'test_completed']);
    }

    public function testEventSuccessful()
    {
        $this->mock->append(new Response(202, ['Content-Length' => 0]));
        $this->push->event(['name' => 'some-event', 'user' => 'some-identifier']);
        $this->assertEquals('/events', $this->mock->getLastRequest()->getUri()->getPath());
    }
}
