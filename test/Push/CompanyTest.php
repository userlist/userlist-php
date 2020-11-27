<?php
namespace Userlist\Test\Push;

use PHPUnit\Framework\TestCase;

use Userlist\Push\Company;

final class CompanyTest extends TestCase
{
    private $company;

    public function setUp(): void
    {
        $this->company = new Company(['identifier' => 'company-1']);
    }

    public function testInitializeWithMissingPayload()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Missing required payload');

        new Company(null);
    }

    public function testInitializeWithMissingIdentifier()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Missing required parameter: identifier');

        new Company(['name' => 'Example, Inc.']);
    }

    public function testInitializeWithString()
    {
        $company = new Company('company-1');
        $this->assertEquals($company->jsonSerialize(), ['identifier' => 'company-1']);
    }

    public function testJsonSerialize()
    {
        $this->assertEquals($this->company->jsonSerialize(), ['identifier' => 'company-1']);
    }

    public function testUrl()
    {
        $this->assertEquals($this->company->url(), '/companies/company-1');
    }
}
