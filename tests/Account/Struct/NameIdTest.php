<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\NameId;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for NameId.
 */
class NameIdTest extends ZimbraTestCase
{
    public function testNameId()
    {
        $name = $this->faker->name;
        $id = $this->faker->uuid;

        $nameId = new NameId($name, $id);
        $this->assertSame($name, $nameId->getName());
        $this->assertSame($id, $nameId->getId());

        $nameId = new NameId('', '');
        $nameId->setName($name)
               ->setId($id);
        $this->assertSame($name, $nameId->getName());
        $this->assertSame($id, $nameId->getId());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" id="$id"/>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($nameId, 'xml'));
        $this->assertEquals($nameId, $this->serializer->deserialize($xml, NameId::class, 'xml'));
    }
}
