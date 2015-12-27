<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Tests\ZimbraAccountTestCase;
use Zimbra\Account\Struct\Attr;

/**
 * Testcase class for AttrsImpl.
 */
class AttrsImplTest extends ZimbraAccountTestCase
{
    public function testAttrsImpl()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($name, $value, true);
        $attrs = $this->getMockForAbstractClass('Zimbra\Account\Struct\AttrsImpl');
 
        $attrs->addAttr($attr);
        $this->assertSame([$attr], $attrs->getAttrs()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<attrs>'
                . '<a name="' . $name . '" pd="true">' . $value . '</a>'
            . '</attrs>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attrs);

        $array = [
            'attrs' => [
                'a' => [
                    [
                        'name' => $name,
                        '_content' => $value,
                        'pd' => true,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $attrs->toArray());
    }
}
