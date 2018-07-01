<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Struct\BlackList;
use Zimbra\Struct\OpValue;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for BlackList.
 */
class BlackListTest extends ZimbraStructTestCase
{
    public function testBlackList()
    {
        $value1 = $this->faker->word;
        $addr1 = new OpValue('+', $value1);

        $blackList = new BlackList([$addr1]);
        $this->assertSame([$addr1], $blackList->getAddrs());

        $value2 = $this->faker->word;
        $addr2 = new OpValue('-', $value2);

        $blackList->addAddr($addr2);
        $this->assertSame([$addr1, $addr2], $blackList->getAddrs());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<blackList>'
                . '<addr op="+">' . $value1 . '</addr>'
                . '<addr op="-">' . $value2 . '</addr>'
            . '</blackList>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($blackList, 'xml'));

        $blackList = $this->serializer->deserialize($xml, 'Zimbra\Account\Struct\BlackList', 'xml');
        $addr1 = $blackList->getAddrs()[0];
        $addr2 = $blackList->getAddrs()[1];

        $this->assertSame('+', $addr1->getOp());
        $this->assertSame($value1, $addr1->getValue());
        $this->assertSame('-', $addr2->getOp());
        $this->assertSame($value2, $addr2->getValue());
    }
}
