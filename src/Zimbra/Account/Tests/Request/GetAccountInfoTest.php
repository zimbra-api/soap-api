<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\GetAccountInfo;
use Zimbra\Struct\AccountSelector;
use Zimbra\Enum\AccountBy;

/**
 * Testcase class for GetAccountInfo.
 */
class GetAccountInfoTest extends ZimbraAccountApiTestCase
{
    public function testGetAccountInfoRequest()
    {
        $value = $this->faker->word;

        $account = new AccountSelector(AccountBy::NAME(), $value);

        $req = new GetAccountInfo($account);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($account, $req->getAccount());

        $req->setAccount($account);
        $this->assertSame($account, $req->getAccount());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAccountInfoRequest>'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
            . '</GetAccountInfoRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAccountInfoRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAccountInfoApi()
    {
        $value = $this->faker->word;
        $account = new AccountSelector(AccountBy::NAME(), $value);

        $this->api->getAccountInfo($account);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GetAccountInfoRequest>'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                    . '</urn1:GetAccountInfoRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
