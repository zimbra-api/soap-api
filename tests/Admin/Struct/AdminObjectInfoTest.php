<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\AdminObjectInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AdminObjectInfo.
 */
class AdminObjectInfoTest extends ZimbraTestCase
{
    public function testAdminObjectInfo()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $key1 = $this->faker->word;
        $value1 = $this->faker->word;
        $key2 = $this->faker->word;
        $value2 = $this->faker->word;

        $attr1 = new Attr($key1, $value1);
        $attr2 = new Attr($key2, $value2);

        $stub = new StubAdminObjectInfo($name, $id, [$attr1]);
        $this->assertSame($name, $stub->getName());
        $this->assertSame($id, $stub->getId());
        $this->assertSame([$attr1], $stub->getAttrList());

        $stub = new StubAdminObjectInfo();
        $stub->setName($name)
             ->setId($id)
             ->setAttrList([$attr1, $attr2]);
        $this->assertSame($name, $stub->getName());
        $this->assertSame($id, $stub->getId());
        $this->assertSame([$attr1, $attr2], $stub->getAttrList());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" id="$id" xmlns:urn="urn:zimbraAdmin">
    <urn:a n="$key1">$value1</urn:a>
    <urn:a n="$key2">$value2</urn:a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($stub, 'xml'));
        $this->assertEquals($stub, $this->serializer->deserialize($xml, StubAdminObjectInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
class StubAdminObjectInfo extends AdminObjectInfo
{
}
