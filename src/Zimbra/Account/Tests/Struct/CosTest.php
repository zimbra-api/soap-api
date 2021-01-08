<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Struct\Cos;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for Cos.
 */
class CosTest extends ZimbraStructTestCase
{
    public function testCos()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->name;

        $cos = new Cos($id, $name);
        $this->assertSame($name, $cos->getName());
        $this->assertSame($id, $cos->getId());

        $cos = new Cos();
        $cos->setName($name)
            ->setId($id);
        $this->assertSame($name, $cos->getName());
        $this->assertSame($id, $cos->getId());

        $xml = <<<EOT
<?xml version="1.0"?>
<cos name="$name" id="$id"/>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cos, 'xml'));
        $this->assertEquals($cos, $this->serializer->deserialize($xml, Cos::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'id' => $id,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($cos, 'json'));
        $this->assertEquals($cos, $this->serializer->deserialize($json, Cos::class, 'json'));
    }
}
