<?php

namespace Zimbra\Struct\Tests;

use JMS\Serializer\Annotation\XmlRoot;
use Zimbra\Struct\AttributeSelector;
use Zimbra\Struct\AttributeSelectorTrait;

/**
 * Testcase class for AttributeSelectorTrait.
 */
class AttributeSelectorTrailTest extends ZimbraStructTestCase
{
    public function testAttributeSelectorTrail()
    {
        $attr1 = $this->faker->word;
        $attr2 = $this->faker->word;
        $attr3 = $this->faker->word;
        $attrs = new AttributeSelectorImp(implode(',', [$attr1, $attr2]));
        $this->assertSame(implode(',', [$attr1, $attr2]), $attrs->getAttrs());
        $attrs->setAttrs(implode(',', [$attr1, $attr2, $attr3]));
        $this->assertSame(implode(',', [$attr1, $attr2, $attr3]), $attrs->getAttrs());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<selector attrs="' . implode(',', [$attr1, $attr2, $attr3]) . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attrs, 'xml'));

        $attrs = $this->serializer->deserialize($xml, 'Zimbra\Struct\Tests\AttributeSelectorImp', 'xml');
        $this->assertSame(implode(',', [$attr1, $attr2, $attr3]), $attrs->getAttrs());
    }
}

/**
 * @XmlRoot(name="selector")
 */
class AttributeSelectorImp implements AttributeSelector
{
    use AttributeSelectorTrait;

    public function __construct($attrs)
    {
        $this->setAttrs($attrs);
    }
}
