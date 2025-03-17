<?php
namespace Userlist\Test\Push;

use PHPUnit\Framework\TestCase;

use Userlist\Push\Relationship;

final class RelationshipTest extends TestCase
{
    private $relationship;

    public function setUp(): void
    {
        $this->relationship = new Relationship(['user' => 'user-1', 'company' => 'company-1']);
    }

    public function testInitializeWithMissingPayload()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Missing required payload');

        new Relationship(null);
    }

    public function testInitializeWithMissingUser()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Missing required parameter: user');

        new Relationship(['company' => 'company-1']);
    }

    public function testInitializeWithMissingCompany()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Missing required parameter: company');

        new Relationship(['user' => 'user-1']);
    }

    public function testJsonSerialize()
    {
        $this->assertEquals($this->relationship->jsonSerialize(), ['user' => 'user-1', 'company' => 'company-1']);
    }
}
