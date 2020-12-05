<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Tests\ZimbraAccountTestCase;
use Zimbra\Account\Struct\NameId;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for NameId.
 */
class NameIdTest extends ZimbraStructTestCase
{
    public function testNameId()
    {
        $name = $this->faker->word;
        $id = $this->faker->word;

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
<nameid name="$name" id="$id"/>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($nameId, 'xml'));
        $this->assertEquals($nameId, $this->serializer->deserialize($xml, NameId::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'id' => $id,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($nameId, 'json'));
        $this->assertEquals($nameId, $this->serializer->deserialize($json, NameId::class, 'json'));
    }
}
