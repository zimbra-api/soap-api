<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Struct\AttributeSelector;
use Zimbra\Struct\AttributeSelectorTrait;
use Zimbra\Struct\Base;

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
        $attrs = new AttributeSelectorImp([$attr1]);
        $this->assertSame($attr1, $attrs->getAttrs());
        $attrs->setAttrs([$attr1, $attr2]);
        $this->assertSame(implode(',', [$attr1, $attr2]), $attrs->getAttrs());
        $attrs->addAttr($attr3);
        $this->assertSame(implode(',', [$attr1, $attr2, $attr3]), $attrs->getAttrs());

        $className = $attrs->className();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<' . $className . ' attrs="' . implode(',', [$attr1, $attr2, $attr3]) . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attrs);

        $array = [
            $className => [
                'attrs' => implode(',', [$attr1, $attr2, $attr3]),
            ],
        ];
        $this->assertEquals($array, $attrs->toArray());
    }
}

class AttributeSelectorImp extends Base implements AttributeSelector
{
    use AttributeSelectorTrait;

    public function __construct(array $attrs = [])
    {
        parent::__construct();
        $this->setAttrs($attrs);

        $this->on('before', function(Base $sender)
        {
            $attrs = $sender->getAttrs();
            if(!empty($attrs))
            {
                $sender->setProperty('attrs', $attrs);
            }
        });
    }
}
