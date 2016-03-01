<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Tests\ZimbraAccountTestCase;
use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\AuthAttrs;

/**
 * Testcase class for AuthAttrs.
 */
class AuthAttrsTest extends ZimbraAccountTestCase
{
    public function testAuthAttrs()
    {
        $name1 = $this->faker->word;
        $value1 = $this->faker->word;
        $attr1 = new Attr($name1, $value1, true);

        $attrs = new AuthAttrs([$attr1]);
        $this->assertSame([$attr1], $attrs->getAttrs()->all());

        $name2 = $this->faker->word;
        $value2 = $this->faker->word;
        $attr2 = new Attr($name2, $value2, false);

        $attrs->addAttr($attr2);
        $this->assertSame([$attr1, $attr2], $attrs->getAttrs()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<attrs>'
                . '<attr name="' . $name1 . '" pd="true">' . $value1 . '</attr>'
                . '<attr name="' . $name2 . '" pd="false">' . $value2 . '</attr>'
            . '</attrs>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attrs);

        $array = [
            'attrs' => [
                'attr' => [
                    [
                        'name' => $name1,
                        '_content' => $value1,
                        'pd' => true,
                    ],
                    [
                        'name' => $name2,
                        '_content' => $value2,
                        'pd' => false,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $attrs->toArray());
    }
}
