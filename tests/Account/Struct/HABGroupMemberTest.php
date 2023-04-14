<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Account\Struct\HABGroupMember;
use Zimbra\Common\Struct\NamedValue;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for HABGroupMember.
 */
class HABGroupMemberTest extends ZimbraTestCase
{
    public function testHABGroupMember()
    {
        $name = $this->faker->email;
        $seniorityIndex = mt_rand(1, 100);

        $key1 = $this->faker->word;
        $value1 = $this->faker->word;
        $key2 = $this->faker->word;
        $value2 = $this->faker->word;

        $attr1 = new NamedValue($key1, $value1);
        $attr2 = new NamedValue($key2, $value2);

        $groupMember = new MockHABGroupMember($name, $seniorityIndex, [$attr1]);
        $this->assertSame([$attr1], $groupMember->getAttrs());
        $groupMember->setAttrs([$attr1, $attr2]);
        $this->assertSame([$attr1, $attr2], $groupMember->getAttrs());

        $xml = <<<EOT
<?xml version="1.0"?>
<result seniorityIndex="$seniorityIndex" xmlns:urn="urn:zimbraAccount">
    <urn:name>$name</urn:name>
    <urn:attr name="$key1">$value1</urn:attr>
    <urn:attr name="$key2">$value2</urn:attr>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($groupMember, 'xml'));
        $this->assertEquals($groupMember, $this->serializer->deserialize($xml, MockHABGroupMember::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAccount', prefix: "urn")]
class MockHABGroupMember extends HABGroupMember
{
}
