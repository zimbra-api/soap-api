<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use JMS\Serializer\Annotation\XmlRoot;
use Zimbra\Account\Struct\ObjectInfo;
use Zimbra\Struct\KeyValuePair;
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

        $stub = new StubObjectInfo('', '');
        $stub->setName($name)
             ->setId($id)
             ->setAttrList([$attr1])
             ->addAttr($attr2);
        $this->assertSame($name, $stub->getName());
        $this->assertSame($id, $stub->getId());
        $this->assertSame([$attr1, $attr2], $stub->getAttrList());

        $xml = <<<EOT
<?xml version="1.0"?>
<stub name="$name" id="$id">
    <a n="$key1">$value1</a>
    <a n="$key2">$value2</a>
</stub>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($stub, 'xml'));
        $this->assertEquals($stub, $this->serializer->deserialize($xml, StubObjectInfo::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'id' => $id,
            'a' => [
                [
                    'n' => $key1,
                    '_content' => $value1,
                ],
                [
                    'n' => $key2,
                    '_content' => $value2,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($stub, 'json'));
        $this->assertEquals($stub, $this->serializer->deserialize($json, StubObjectInfo::class, 'json'));
    }
}

/**
 * @XmlRoot(name="stub")
 */
class StubObjectInfo extends ObjectInfo
{
}