<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\ModifyWhiteBlackList;
use Zimbra\Account\Struct\BlackList;
use Zimbra\Account\Struct\WhiteList;
use Zimbra\Struct\OpValue;

/**
 * Testcase class for ModifyWhiteBlackList.
 */
class ModifyWhiteBlackListTest extends ZimbraAccountApiTestCase
{
    public function testModifyWhiteBlackListRequest()
    {
        $value = $this->faker->word;
        $white = new OpValue('+', $value);
        $black = new OpValue('-', $value);
        $whiteList = new WhiteList([$white]);
        $blackList = new BlackList([$black]);

        $req = new ModifyWhiteBlackList($whiteList, $blackList);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($whiteList, $req->getWhiteList());
        $this->assertSame($blackList, $req->getBlackList());

        $req->setWhiteList($whiteList)
            ->setBlackList($blackList);
        $this->assertSame($whiteList, $req->getWhiteList());
        $this->assertSame($blackList, $req->getBlackList());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyWhiteBlackListRequest>'
                . '<whiteList>'
                    . '<addr op="+">' . $value . '</addr>'
                . '</whiteList>'
                . '<blackList>'
                    . '<addr op="-">' . $value . '</addr>'
                . '</blackList>'
            . '</ModifyWhiteBlackListRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyWhiteBlackListRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'whiteList' => [
                    'addr' => [
                        [
                            'op' => '+',
                            '_content' => $value,
                        ],
                    ],
                ],
                'blackList' => [
                    'addr' => [
                        [
                            'op' => '-',
                            '_content' => $value,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyWhiteBlackListApi()
    {
        $value = $this->faker->word;
        $white = new OpValue('+', $value);
        $black = new OpValue('-', $value);
        $whiteList = new WhiteList([$white]);
        $blackList = new BlackList([$black]);

        $this->api->modifyWhiteBlackList($whiteList, $blackList);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:ModifyWhiteBlackListRequest>'
                        . '<urn1:whiteList>'
                            . '<urn1:addr op="+">' . $value . '</urn1:addr>'
                        . '</urn1:whiteList>'
                        . '<urn1:blackList>'
                            . '<urn1:addr op="-">' . $value . '</urn1:addr>'
                        . '</urn1:blackList>'
                    . '</urn1:ModifyWhiteBlackListRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
