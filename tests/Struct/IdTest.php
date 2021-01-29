<?php declare(strict_types=1);

namespace Zimbra\Tests\Struct;

use Zimbra\Struct\Id;

/**
 * Testcase class for Id.
 */
class IdTest extends ZimbraStructTestCase
{
    public function testId()
    {
        $value = $this->faker->uuid;

        $id = new Id($value);
        $this->assertSame($value, $id->getId());

        $id->setId($value);
        $this->assertSame($value, $id->getId());

        $xml = <<<EOT
<?xml version="1.0"?>
<id id="$value" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($id, 'xml'));
        $this->assertEquals($id, $this->serializer->deserialize($xml, Id::class, 'xml'));

        $json = json_encode([
            'id' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($id, 'json'));
        $this->assertEquals($id, $this->serializer->deserialize($json, Id::class, 'json'));
    }
}
