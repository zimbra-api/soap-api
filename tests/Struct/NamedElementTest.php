<?php declare(strict_types=1);

namespace Zimbra\Tests\Struct;

use Zimbra\Struct\NamedElement;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for NamedElement.
 */
class NamedElementTest extends ZimbraTestCase
{
    public function testNamedElement()
    {
        $name = $this->faker->word;
        $named = new NamedElement($name);
        $this->assertSame($name, $named->getName());

        $named->setName($name);
        $this->assertSame($name, $named->getName());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($named, 'xml'));
        $this->assertEquals($named, $this->serializer->deserialize($xml, NamedElement::class, 'xml'));

        $json = json_encode([
            'name' => $name,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($named, 'json'));
        $this->assertEquals($named, $this->serializer->deserialize($json, NamedElement::class, 'json'));
    }
}
