<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetAccountInfo;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;

/**
 * Testcase class for GetAccountInfo.
 */
class GetAccountInfoTest extends ZimbraAdminApiTestCase
{
    public function testGetAccountInfoRequest()
    {
        $value = $this->faker->word;
        $account = new AccountSelector(AccountBy::NAME(), $value);
        $req = new GetAccountInfo($account);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
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
                '_jsns' => 'urn:zimbraAdmin',
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

        $this->api->getAccountInfo(
            $account
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAccountInfoRequest>'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                    . '</urn1:GetAccountInfoRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
