<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Struct\AttributeName;

/**
 * Testcase class for AttributeName.
 */
class AttributeNameTest extends ZimbraStructTestCase
{
    public function testAttributeName()
    {
        $name = $this->faker->word;
        $a = new AttributeName($name);
        $this->assertSame($name, $a->getName());

        $a->setName($name);
        $this->assertSame($name, $a->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<a n="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $a);

        $array = [
            'a' => [
                'n' => $name,
            ],
        ];
        $this->assertEquals($array, $a->toArray());
    }
}
