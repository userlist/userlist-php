<?php
namespace Userlist\Test\Push;

use PHPUnit\Framework\TestCase;
use Userlist\Push\Message;

final class MessageTest extends TestCase
{
    private $message;

    public function setUp(): void
    {
        $this->message = new Message([
            'user' => 'user-1',
            'template' => 'welcome-email'
        ]);
    }

    public function testInitializeWithMissingPayload()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Missing required payload');

        new Message(null);
    }

    public function testJsonSerialize()
    {
        $this->assertEquals(
            $this->message->jsonSerialize(),
            ['user' => 'user-1', 'template' => 'welcome-email']
        );
    }
}
