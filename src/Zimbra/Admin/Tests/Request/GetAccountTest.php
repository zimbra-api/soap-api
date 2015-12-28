<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetAccount;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;

/**
 * Testcase class for GetAccount.
 */
class GetAccountTest extends ZimbraAdminApiTestCase
{
    public function testGetAccountRequest()
    {
        $value = $this->faker->word;
        $attrs = $this->faker->word;
        $account = new AccountSelector(AccountBy::NAME(), $value);
        $req = new GetAccount($account, false, [$attrs]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($account, $req->getAccount());
        $this->assertFalse($req->getApplyCos());
        $this->assertSame($attrs, $req->getAttrs());

        $req->setAccount($account)
            ->setApplyCos(true);
        $this->assertSame($account, $req->getAccount());
        $this->assertTrue($req->getApplyCos());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAccountRequest applyCos="true" attrs="' . $attrs . '">'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
            . '</GetAccountRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAccountRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'applyCos' => true,
                'attrs' => $attrs,
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAccountApi()
    {
        $value = $this->faker->word;
        $attrs = $this->faker->word;
        $account = new AccountSelector(AccountBy::NAME(), $value);

        $this->api->getAccount(
            $account, true, [$attrs]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAccountRequest applyCos="true" attrs="' . $attrs . '">'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                    . '</urn1:GetAccountRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
