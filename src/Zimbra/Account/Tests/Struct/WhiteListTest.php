<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Tests\ZimbraAccountTestCase;
use Zimbra\Account\Struct\WhiteList;
use Zimbra\Struct\OpValue;

/**
 * Testcase class for WhiteList.
 */
class WhiteListTest extends ZimbraAccountTestCase
{
    public function testWhiteList()
    {
        $value = $this->faker->word;

        $addr1 = new OpValue('+', $value);
        $addr2 = new OpValue('-', $value);

        $whiteList = new WhiteList([$addr1]);
        $this->assertSame([$addr1], $whiteList->getAddrs()->all());

        $whiteList->addAddr($addr2);
        $this->assertSame([$addr1, $addr2], $whiteList->getAddrs()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<whiteList>'
                . '<addr op="+">' . $value . '</addr>'
                . '<addr op="-">' . $value . '</addr>'
            . '</whiteList>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $whiteList);

        $array = [
            'whiteList' => [
                'addr' => [
                    [
                        'op' => '+',
                        '_content' => $value,
                    ],
                    [
                        'op' => '-',
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $whiteList->toArray());
    }
}
