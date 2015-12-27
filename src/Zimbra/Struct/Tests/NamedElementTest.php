<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Struct\NamedElement;

/**
 * Testcase class for NamedElement.
 */
class NamedElementTest extends ZimbraStructTestCase
{
    public function testNamedElement()
    {
        $name = $this->faker->word;
        $named = new NamedElement($name);
        $this->assertSame($name, $named->getName());

        $named->setName($name);
        $this->assertSame($name, $named->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<named name="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $named);

        $array = [
            'named' => [
                'name' => $name,
            ],
        ];
        $this->assertEquals($array, $named->toArray());
    }
}
