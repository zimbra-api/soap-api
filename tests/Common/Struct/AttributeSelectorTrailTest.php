<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Struct;

use Zimbra\Common\Struct\{AttributeSelector, AttributeSelectorTrait};
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AttributeSelectorTrait.
 */
class AttributeSelectorTrailTest extends ZimbraTestCase
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
<result attrs="$attrs" />
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

class AttributeSelectorImp implements AttributeSelector
{
    use AttributeSelectorTrait;

    public function __construct($attrSel)
    {
        $this->setAttrs($attrSel);
    }
}
