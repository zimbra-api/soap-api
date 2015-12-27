<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Struct\AttrsImplTrait;
use Zimbra\Struct\Base;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for AttrsImplTrait.
 */
class AttrsImplTraitTest extends ZimbraStructTestCase
{
    public function testAttrsImplTrait()
    {
        $key1 = $this->faker->word;
        $value1 = $this->faker->word;
        $attr1 = new KeyValuePair($key1, $value1);

        $key2 = $this->faker->word;
        $value2 = $this->faker->word;
        $attr2 = new KeyValuePair($key2, $value2);

        $key3 = $this->faker->word;
        $value3 = $this->faker->word;
        $attr3 = new KeyValuePair($key3, $value3);

        $attrs = new AttrsImplImp([$attr1]);
        $this->assertSame([$attr1], $attrs->getAttrs()->all());
        $attrs->setAttrs([$attr1, $attr2]);
        $this->assertSame([$attr1, $attr2], $attrs->getAttrs()->all());
        $attrs->addAttr($attr3);
        $this->assertSame([$attr1, $attr2, $attr3], $attrs->getAttrs()->all());

        $className = $attrs->className();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<' . $className . '>'
                . '<a n="' . $key1 . '">' . $value1 . '</a>'
                . '<a n="' . $key2 . '">' . $value2 . '</a>'
                . '<a n="' . $key3 . '">' . $value3 . '</a>'
            . '</' . $className . '>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attrs);

        $array = [
            $className => [
                'a' => [
                    [
                        'n' => $key1,
                        '_content' => $value1,
                    ],
                    [
                        'n' => $key2,
                        '_content' => $value2,
                    ],
                    [
                        'n' => $key3,
                        '_content' => $value3,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $attrs->toArray());
    }
}

class AttrsImplImp extends Base
{
    use AttrsImplTrait;
}
