<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

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

        $stub = new StubHABMember();
        $stub->setName($name)
             ->setSeniorityIndex($seniorityIndex);
        $this->assertSame($name, $stub->getName());
        $this->assertSame($seniorityIndex, $stub->getSeniorityIndex());

        $xml = <<<EOT
<?xml version="1.0"?>
<result seniorityIndex="$seniorityIndex" xmlns:urn="urn:zimbraAccount">
    <urn:name>$name</urn:name>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($stub, 'xml'));
        $this->assertEquals($stub, $this->serializer->deserialize($xml, StubHABMember::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAccount", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraAccount', prefix: "urn")]
class StubHABMember extends HABMember
{
}
