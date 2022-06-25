<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\HABMember;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for HABMember.
 */
class HABMemberTest extends ZimbraTestCase
{
    public function testHABMember()
    {
        $name = $this->faker->email;
        $seniorityIndex = mt_rand(1, 100);

        $stub = new StubHABMember($name, $seniorityIndex);
        $this->assertSame($name, $stub->getName());
        $this->assertSame($seniorityIndex, $stub->getSeniorityIndex());

        $stub = new StubHABMember('', 0);
        $stub->setName($name)
             ->setSeniorityIndex($seniorityIndex);
        $this->assertSame($name, $stub->getName());
        $this->assertSame($seniorityIndex, $stub->getSeniorityIndex());

        $xml = <<<EOT
<?xml version="1.0"?>
<result seniorityIndex="$seniorityIndex">
    <name>$name</name>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($stub, 'xml'));
        $this->assertEquals($stub, $this->serializer->deserialize($xml, StubHABMember::class, 'xml'));
    }
}

class StubHABMember extends HABMember
{
}
