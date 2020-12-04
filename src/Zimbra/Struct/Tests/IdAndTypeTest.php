<?php declare(strict_types=1);

namespace Zimbra\Struct\Tests;

use Zimbra\Struct\IdAndType;

/**
 * Testcase class for IdAndType.
 */
class IdAndTypeTest extends ZimbraStructTestCase
{
    public function testIdAndType()
    {
        $id = $this->faker->uuid;
        $type = $this->faker->word;

        $idType = new IdAndType($id, $type);
        $this->assertSame($id, $idType->getId());
        $this->assertSame($type, $idType->getType());

        $idType = new IdAndType('', '');
        $idType->setId($id)
               ->setType($type);
        $this->assertSame($id, $idType->getId());
        $this->assertSame($type, $idType->getType());

        $xml = <<<EOT
<?xml version="1.0"?>
<IdAndType id="$id" type="$type" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($idType, 'xml'));
        $this->assertEquals($idType, $this->serializer->deserialize($xml, IdAndType::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'type' => $type,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($idType, 'json'));
        $this->assertEquals($idType, $this->serializer->deserialize($json, IdAndType::class, 'json'));
    }
}
