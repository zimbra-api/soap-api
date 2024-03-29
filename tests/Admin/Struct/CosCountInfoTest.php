<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\CosCountInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CosCountInfo.
 */
class CosCountInfoTest extends ZimbraTestCase
{
    public function testCosCountInfo()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $value = mt_rand(1, 100);
        $cos = new CosCountInfo($name, $id, $value);
        $this->assertSame($name, $cos->getName());
        $this->assertSame($id, $cos->getId());
        $this->assertSame($value, $cos->getValue());

        $cos = new CosCountInfo();
        $cos->setName($name)
            ->setId($id)
            ->setValue($value);
        $this->assertSame($name, $cos->getName());
        $this->assertSame($id, $cos->getId());
        $this->assertSame($value, $cos->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" id="$id">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cos, 'xml'));
        $this->assertEquals($cos, $this->serializer->deserialize($xml, CosCountInfo::class, 'xml'));
    }
}
