<?php declare(strict_types=1);

namespace Zimbra\Struct\Tests;

use Zimbra\Struct\NamedValue;

/**
 * Testcase class for NamedValue.
 */
class NamedValueTest extends ZimbraStructTestCase
{
    public function testNamedValue()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;

        $named = new NamedValue($name, $value);
        $this->assertSame($name, $named->getName());
        $this->assertSame($value, $named->getValue());

        $named->setName($name);
        $this->assertSame($name, $named->getName());

        $xml = <<<EOT
<?xml version="1.0"?>
<named name="$name">$value</named>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($named, 'xml'));
        $this->assertEquals($named, $this->serializer->deserialize($xml, NamedValue::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($named, 'json'));
        $this->assertEquals($named, $this->serializer->deserialize($json, NamedValue::class, 'json'));
    }
}
