<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\AttrsImpl;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

use JMS\Serializer\Annotation\XmlRoot;

/**
 * Testcase class for AttrsImpl.
 */
class AttrsImplTest extends ZimbraStructTestCase
{
    public function testAttrsImpl()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($name, $value, true);
        $attrs = new MockAttrsImpl();
 
        $attrs->addAttr($attr);
        $this->assertSame([$attr], $attrs->getAttrs());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<attrs>'
                . '<a name="' . $name . '" pd="true">' . $value . '</a>'
            . '</attrs>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attrs, 'xml'));

        $attrs = $this->serializer->deserialize($xml, 'Zimbra\Account\Tests\Struct\MockAttrsImpl', 'xml');
        $attr = $attrs->getAttrs()[0];
        $this->assertSame($name, $attr->getName());
        $this->assertSame($value, $attr->getValue());
        $this->assertTrue($attr->getPermDenied());
    }
}

/** @XmlRoot(name="attrs") */
class MockAttrsImpl extends AttrsImpl
{
}
