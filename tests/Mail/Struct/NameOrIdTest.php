<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\NameOrId;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for NameOrIdTest.
 */
class NameOrIdTest extends ZimbraTestCase
{
    public function testNameOrId()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->name;

        $doc = NameOrId::createForName($name);
        $this->assertSame($name, $doc->getName());
        $this->assertNull($doc->getId());
        $doc = NameOrId::createForId($id);
        $this->assertNull($doc->getName());
        $this->assertSame($id, $doc->getId());

        $doc = new NameOrId(
            $name, $id
        );
        $this->assertSame($name, $doc->getName());
        $this->assertSame($id, $doc->getId());

        $doc = new NameOrId();
        $doc->setId($id)
            ->setName($name);
        $this->assertSame($name, $doc->getName());
        $this->assertSame($id, $doc->getId());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" id="$id" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($doc, 'xml'));
        $this->assertEquals($doc, $this->serializer->deserialize($xml, NameOrId::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'id' => $id,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($doc, 'json'));
        $this->assertEquals($doc, $this->serializer->deserialize($json, NameOrId::class, 'json'));
    }
}
