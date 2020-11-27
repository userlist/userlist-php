<?php
namespace Userlist\Test\Push;

use PHPUnit\Framework\TestCase;

use Userlist\Push\Relation;
use Userlist\Push\User;
use Userlist\Push\Client;

final class RelationTest extends TestCase
{
    private $client;
    private $relation;
    private $payload;

    public function setUp(): void
    {
        $this->client = $this->getMockBuilder(Client::class)
                            ->disableOriginalConstructor()
                            ->setMethods(['post', 'delete'])
                            ->getMock();

        $this->relation = new Relation(User::class, $this->client);

        $this->payload = ['identifier' => 'user-1'];
    }

    public function testPush()
    {
        $this->client
            ->expects($this->once())
            ->method('post')
            ->with('/users', ['identifier' => 'user-1']);

        $this->relation->push($this->payload);
    }

    public function testCreate()
    {
        $this->client
            ->expects($this->once())
            ->method('post')
            ->with('/users', ['identifier' => 'user-1']);

        $this->relation->create($this->payload);
    }

    public function testDeleteWithPayload()
    {
        $this->client->expects($this->once())
            ->method('delete')
            ->with('/users/user-1');

        $this->relation->delete($this->payload);
    }

    public function testDeleteWithString()
    {
        $this->client->expects($this->once())
            ->method('delete')
            ->with('/users/user-1');

        $this->relation->delete($this->payload['identifier']);
    }
}
