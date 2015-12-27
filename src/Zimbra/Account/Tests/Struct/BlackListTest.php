<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Tests\ZimbraAccountTestCase;
use Zimbra\Account\Struct\BlackList;
use Zimbra\Struct\OpValue;

/**
 * Testcase class for BlackList.
 */
class BlackListTest extends ZimbraAccountTestCase
{
    public function testBlackList()
    {
        $value1 = $this->faker->word;
        $addr1 = new OpValue('+', $value1);

        $blackList = new BlackList([$addr1]);
        $this->assertSame([$addr1], $blackList->getAddrs()->all());

        $value2 = $this->faker->word;
        $addr2 = new OpValue('-', $value2);

        $blackList->addAddr($addr2);
        $this->assertSame([$addr1, $addr2], $blackList->getAddrs()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<blackList>'
                . '<addr op="+">' . $value1 . '</addr>'
                . '<addr op="-">' . $value2 . '</addr>'
            . '</blackList>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $blackList);

        $array = [
            'blackList' => [
                'addr' => [
                    [
                        'op' => '+',
                        '_content' => $value1,
                    ],
                    [
                        'op' => '-',
                        '_content' => $value2,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $blackList->toArray());
    }
}
