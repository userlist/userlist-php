<?php
namespace Userlist\Test\Push;

use PHPUnit\Framework\TestCase;

use Userlist\Push\Event;

final class EventTest extends TestCase
{
    private $event;

    public function setUp(): void
    {
        $this->event = new Event(['name' => 'test-event', 'user' => 'user-1', 'company' => 'company-1']);
    }

    public function testInitializeWithMissingPayload()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Missing required payload');

        new Event(null);
    }

    public function testInitializeWithMissingName()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Missing required parameter: name');

        new Event(['user' => 'user-1', 'company' => 'company-1']);
    }

    public function testInitializeWithUserAndCompany()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Missing required parameter: user or company');

        new Event(['name' => 'test-event']);
    }

    public function testJsonSerialize()
    {
        $this->assertEquals($this->event->jsonSerialize(), ['name' => 'test-event', 'user' => 'user-1', 'company' => 'company-1']);
    }

    public function testUrl()
    {
        $this->assertEquals($this->event->url(), null);
    }
}
