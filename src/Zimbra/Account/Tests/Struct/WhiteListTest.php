<?php declare(strict_types=1);

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
        $this->assertEquals($whiteList, $this->serializer->deserialize($xml, WhiteList::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($whiteList, 'json'));
        $this->assertEquals($whiteList, $this->serializer->deserialize($json, WhiteList::class, 'json'));
    }
}
