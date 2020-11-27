<?php
namespace Userlist\Test\Push;

use PHPUnit\Framework\TestCase;

use Userlist\Push\User;

final class UserTest extends TestCase
{
    private $user;

    public function setUp(): void
    {
        $this->user = new User(['identifier' => 'user-1']);
    }

    public function testInitializeWithMissingPayload()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Missing required payload');

        new User(null);
    }

    public function testInitializeWithMissingIdentifier()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Missing required parameter: identifier');

        new User(['email' => 'test@example.com']);
    }

    public function testInitializeWithString()
    {
        $user = new User('user-1');
        $this->assertEquals($user->jsonSerialize(), ['identifier' => 'user-1']);
    }

    public function testJsonSerialize()
    {
        $this->assertEquals($this->user->jsonSerialize(), ['identifier' => 'user-1']);
    }

    public function testUrl()
    {
        $this->assertEquals($this->user->url(), '/users/user-1');
    }
}
