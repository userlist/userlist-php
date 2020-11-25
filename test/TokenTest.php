<?php
namespace Userlist\Test;

use PHPUnit\Framework\TestCase;

final class TokenTest extends TestCase
{
  public $config;

  public function setUp(): void
  {
      $this->config = new \Userlist\Config([
          'push_key' => 'some-push-key',
          'push_id' => 'some-push-id'
      ]);
  }

  public function testStaticGenerate()
  {
    $token = \Userlist\Token::generate('user-identifier', $this->config);
    $this->assertMatchesRegularExpression('/[a-z0-9_-]+\.[a-z0-9_-]+\.[a-z0-9_-]+/i', $token);
  }

  public function testMissingIdentifier() {
    $this->expectException(\InvalidArgumentException::class);
    $this->expectExceptionMessage('Missing required identifier');
    $token = \Userlist\Token::generate(null, $this->config);
  }

  public function testMissingPushId() {
    $this->config->set('push_id', null);
    $token = \Userlist\Token::generate('user-identifier', $this->config);
    $this->assertNull($token);
  }

  public function testMissingPushKey() {
    $this->config->set('push_key', null);
    $token = \Userlist\Token::generate('user-identifier', $this->config);
    $this->assertNull($token);
  }
}
