<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Struct\WhiteList;
use Zimbra\Struct\OpValue;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for WhiteList.
 */
class WhiteListTest extends ZimbraStructTestCase
{
    public function testWhiteList()
    {
        $value = $this->faker->word;

        $addr1 = new OpValue('+', $value);
        $addr2 = new OpValue('-', $value);

        $whiteList = new WhiteList([$addr1]);
        $this->assertSame([$addr1], $whiteList->getAddrs());

        $whiteList->addAddr($addr2);
        $this->assertSame([$addr1, $addr2], $whiteList->getAddrs());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<whiteList>'
                . '<addr op="+">' . $value . '</addr>'
                . '<addr op="-">' . $value . '</addr>'
            . '</whiteList>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($whiteList, 'xml'));

        $whiteList = $this->serializer->deserialize($xml, 'Zimbra\Account\Struct\WhiteList', 'xml');
        $addr1 = $whiteList->getAddrs()[0];
        $addr2 = $whiteList->getAddrs()[1];
    
        $this->assertSame('+', $addr1->getOp());
        $this->assertSame($value, $addr1->getValue());
        $this->assertSame('-', $addr2->getOp());
        $this->assertSame($value, $addr2->getValue());
    }
}
