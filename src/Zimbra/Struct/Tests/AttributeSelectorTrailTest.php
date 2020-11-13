<?php declare(strict_types=1);

namespace Zimbra\Struct\Tests;

use JMS\Serializer\Annotation\XmlRoot;
use Zimbra\Struct\{AttributeSelector, AttributeSelectorTrait};

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
        $this->assertEquals($attrs, $this->serializer->deserialize($xml, AttributeSelectorImp::class, 'xml'));

        $json = json_encode([
            'attrs' => implode(',', [$attr1, $attr2, $attr3]),
        ]);
        $this->assertSame($json, $this->serializer->serialize($attrs, 'json'));
        $this->assertEquals($attrs, $this->serializer->deserialize($json, AttributeSelectorImp::class, 'json'));
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
