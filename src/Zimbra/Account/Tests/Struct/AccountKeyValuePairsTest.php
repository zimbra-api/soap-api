<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Tests\ZimbraAccountTestCase;
use \Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for AccountKeyValuePairs.
 */
class AccountKeyValuePairsTest extends ZimbraAccountTestCase
{
    public function testAccountKeyValuePairs()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new KeyValuePair($key, $value);
        $attrs = $this->getMockForAbstractClass('Zimbra\Account\Struct\AccountKeyValuePairs');

        $attrs->addAttr($attr);
        $this->assertSame([$attr], $attrs->getAttrs()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<attrs>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</attrs>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attrs);

        $array = [
            'attrs' => [
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $attrs->toArray());
    }
}
