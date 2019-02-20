<?php
namespace Userlist\Test;

use PHPUnit\Framework\TestCase;

final class ConfigTest extends TestCase
{
    public function tearDown()
    {
        putenv("USERLIST_PUSH_KEY=");
        putenv("USERLIST_PUSH_ENDPOINT=");
    }

    public function testConfigFromArray()
    {
        $config = new \Userlist\Config(['key' => 'value']);
        $this->assertEquals('value', $config->get('key'));
    }

    public function testConfigFromConfig()
    {
        $other = new \Userlist\Config(['key' => 'value']);
        $config = new \Userlist\Config($other);
        $this->assertEquals('value', $config->get('key'));
    }

    public function testPushKeyDefaultValue()
    {
        $config = new \Userlist\Config();
        $this->assertNull($config->get('push_key'));
    }

    public function testPushKeyFromEnvironment()
    {
        putenv("USERLIST_PUSH_KEY=some-push-key-from-env");

        $config = new \Userlist\Config();
        $this->assertEquals('some-push-key-from-env', $config->get('push_key'));
    }

    public function testPushKeyFromConstructor()
    {
        $config = new \Userlist\Config(['push_key' => 'some-push-key-from-constructor']);
        $this->assertEquals('some-push-key-from-constructor', $config->get('push_key'));
    }

    public function testPushEndpointDefaultValue()
    {
        $config = new \Userlist\Config();
        $this->assertEquals('https://push.userlist.io/', $config->get('push_endpoint'));
    }

    public function testPushEndpointFromEnvironment()
    {
        putenv("USERLIST_PUSH_ENDPOINT=http://example.com");

        $config = new \Userlist\Config();
        $this->assertEquals('http://example.com', $config->get('push_endpoint'));
    }

    public function testPushEndpointFromConstructor()
    {
        $config = new \Userlist\Config(['push_endpoint' => 'http://localhost']);
        $this->assertEquals('http://localhost', $config->get('push_endpoint'));
    }
}
