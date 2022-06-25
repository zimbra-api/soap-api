<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Struct;

use Zimbra\Common\Struct\IdAndType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for IdAndType.
 */
class IdAndTypeTest extends ZimbraTestCase
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
<result id="$id" type="$type" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($idType, 'xml'));
        $this->assertEquals($idType, $this->serializer->deserialize($xml, IdAndType::class, 'xml'));
    }
}
