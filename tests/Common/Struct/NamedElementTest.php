<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Struct;

use Zimbra\Common\Struct\NamedElement;
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
    }
}
