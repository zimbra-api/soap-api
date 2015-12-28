<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for AdminAttrsImpl.
 */
class AdminAttrsImplTest extends ZimbraAdminTestCase
{
    public function testAdminAttrsImpl()
    {
        $stub = $this->getMockForAbstractClass('\Zimbra\Admin\Struct\AdminAttrsImpl');

        $key1 = $this->faker->word;
        $value1 = $this->faker->word;
        $key2 = $this->faker->word;
        $value2 = $this->faker->word;
        $key3 = $this->faker->word;
        $value3 = $this->faker->word;

        $attr1 = new KeyValuePair($key1, $value1);
        $attr2 = new KeyValuePair($key2, $value2);
        $attr3 = new KeyValuePair($key3, $value3);
        $stub->setAttrs([$attr1, $attr2])->addAttr($attr3);
        foreach ($stub->getAttrs() as $attr)
        {
            $this->assertInstanceOf('\Zimbra\Struct\KeyValuePair', $attr);
        }

        $arr = [
            'attrs' => [
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
        $this->assertEquals($arr, $stub->toArray());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<attrs>'
                . '<a n="' . $key1 . '">' . $value1 . '</a>'
                . '<a n="' . $key2 . '">' . $value2 . '</a>'
                . '<a n="' . $key3 . '">' . $value3 . '</a>'
            . '</attrs>';
        $this->assertXmlStringEqualsXmlString($xml, $stub->toXml()->asXml());
    }
}
