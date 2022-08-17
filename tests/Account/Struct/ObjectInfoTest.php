<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Account\Struct\ObjectInfo;
use Zimbra\Common\Struct\KeyValuePair;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ObjectInfo.
 */
class ObjectInfoTest extends ZimbraTestCase
{
    public function testObjectInfo()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $key1 = $this->faker->word;
        $value1 = $this->faker->word;
        $key2 = $this->faker->word;
        $value2 = $this->faker->word;

        $attr1 = new KeyValuePair($key1, $value1);
        $attr2 = new KeyValuePair($key2, $value2);

        $stub = new StubObjectInfo($name, $id, [$attr1]);
        $this->assertSame($name, $stub->getName());
        $this->assertSame($id, $stub->getId());
        $this->assertSame([$attr1], $stub->getAttrList());

        $stub = new StubObjectInfo();
        $stub->setName($name)
             ->setId($id)
             ->setAttrList([$attr1, $attr2]);
        $this->assertSame($name, $stub->getName());
        $this->assertSame($id, $stub->getId());
        $this->assertSame([$attr1, $attr2], $stub->getAttrList());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" id="$id" xmlns:urn="urn:zimbraAccount">
    <urn:a n="$key1">$value1</urn:a>
    <urn:a n="$key2">$value2</urn:a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($stub, 'xml'));
        $this->assertEquals($stub, $this->serializer->deserialize($xml, StubObjectInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAccount', prefix: 'urn')]
class StubObjectInfo extends ObjectInfo
{
}
