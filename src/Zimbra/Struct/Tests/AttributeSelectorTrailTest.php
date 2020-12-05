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
        $attrs = implode(',', [$attr1, $attr2, $attr3]);
        $attrSel = new AttributeSelectorImp(implode(',', [$attr1, $attr2]));
        $this->assertSame(implode(',', [$attr1, $attr2]), $attrSel->getAttrs());
        $attrSel->setAttrs($attrs);
        $this->assertSame($attrs, $attrSel->getAttrs());
        $attrSel = new AttributeSelectorImp($attr1);
        $attrSel->addAttrs($attr2, $attr3);
        $this->assertSame($attrs, $attrSel->getAttrs());

        $xml = <<<EOT
<?xml version="1.0"?>
<selector attrs="$attrs" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attrSel, 'xml'));
        $this->assertEquals($attrSel, $this->serializer->deserialize($xml, AttributeSelectorImp::class, 'xml'));

        $json = json_encode([
            'attrs' => $attrs,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($attrSel, 'json'));
        $this->assertEquals($attrSel, $this->serializer->deserialize($json, AttributeSelectorImp::class, 'json'));
    }
}

/**
 * @XmlRoot(name="selector")
 */
class AttributeSelectorImp implements AttributeSelector
{
    use AttributeSelectorTrait;

    public function __construct($attrSel)
    {
        $this->setAttrs($attrSel);
    }
}
