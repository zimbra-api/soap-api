<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\CosInfo;
use Zimbra\Admin\Struct\CosInfoAttr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CosInfo.
 */
class CosInfoTest extends ZimbraTestCase
{
    public function testCosInfo()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $key1 = $this->faker->word;
        $value1 = $this->faker->word;
        $key2 = $this->faker->word;
        $value2 = $this->faker->word;

        $attr1 = new CosInfoAttr($key1, $value1, TRUE, FALSE);
        $attr2 = new CosInfoAttr($key2, $value2, FALSE, TRUE);

        $cos = new StubCosInfo($name, $id, FALSE, [$attr1]);
        $this->assertSame($name, $cos->getName());
        $this->assertSame($id, $cos->getId());
        $this->assertFalse($cos->getIsDefaultCos());
        $this->assertSame([$attr1], $cos->getAttrList());

        $cos = new StubCosInfo();
        $cos->setName($name)
             ->setId($id)
             ->setIsDefaultCos(TRUE)
             ->setAttrList([$attr1, $attr2]);
        $this->assertSame($name, $cos->getName());
        $this->assertSame($id, $cos->getId());
        $this->assertTrue($cos->getIsDefaultCos());
        $this->assertSame([$attr1, $attr2], $cos->getAttrList());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" id="$id" isDefaultCos="true" xmlns:urn="urn:zimbraAdmin">
    <urn:a n="$key1" c="true" pd="false">$value1</urn:a>
    <urn:a n="$key2" c="false" pd="true">$value2</urn:a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cos, 'xml'));
        $this->assertEquals($cos, $this->serializer->deserialize($xml, StubCosInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubCosInfo extends CosInfo
{
}
