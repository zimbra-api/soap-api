<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\CosCountInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CosCountInfo.
 */
class CosCountInfoTest extends ZimbraStructTestCase
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

        $cos = new CosCountInfo('', '');
        $cos->setName($name)
            ->setId($id)
            ->setValue($value);
        $this->assertSame($name, $cos->getName());
        $this->assertSame($id, $cos->getId());
        $this->assertSame($value, $cos->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<cos name="$name" id="$id">$value</cos>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cos, 'xml'));
        $this->assertEquals($cos, $this->serializer->deserialize($xml, CosCountInfo::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'id' => $id,
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($cos, 'json'));
        $this->assertEquals($cos, $this->serializer->deserialize($json, CosCountInfo::class, 'json'));
    }
}
