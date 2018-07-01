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
        $attr = new AttributeName($name);
        $this->assertSame($name, $attr->getName());

        $attr = new AttributeName('');
        $attr->setName($name);
        $this->assertSame($name, $attr->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<a n="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attr, 'xml'));

        $attr = $this->serializer->deserialize($xml, 'Zimbra\Struct\AttributeName', 'xml');
        $this->assertSame($name, $attr->getName());
    }
}
