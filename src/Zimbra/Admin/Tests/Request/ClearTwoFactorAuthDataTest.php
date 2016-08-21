<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\ClearTwoFactorAuthData;
use Zimbra\Admin\Struct\CosSelector;
use Zimbra\Enum\AccountBy;
use Zimbra\Enum\CosBy;
use Zimbra\Struct\AccountSelector;

/**
 * Testcase class for ClearTwoFactorAuthData.
 */
class ClearTwoFactorAuthDataTest extends ZimbraAdminApiTestCase
{
    public function testClearTwoFactorAuthDataRequest()
    {
        $value = $this->faker->word;
        $cos = new CosSelector(CosBy::NAME(), $value);
        $account = new AccountSelector(AccountBy::NAME(), $value);

        $req = new ClearTwoFactorAuthData($cos, $account);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($cos, $req->getCos());
        $this->assertSame($account, $req->getAccount());

        $req->setCos($cos)
            ->setAccount($account);
        $this->assertSame($cos, $req->getCos());
        $this->assertSame($account, $req->getAccount());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ClearTwoFactorAuthDataRequest>'
                . '<cos by="' . CosBy::NAME() . '">' . $value . '</cos>'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
            . '</ClearTwoFactorAuthDataRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ClearTwoFactorAuthDataRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'cos' => [
                    'by' => CosBy::NAME()->value(),
                    '_content' => $value,
                ],
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testClearTwoFactorAuthDataApi()
    {
        $value = $this->faker->word;
        $cos = new CosSelector(CosBy::NAME(), $value);
        $account = new AccountSelector(AccountBy::NAME(), $value);

        $this->api->clearTwoFactorAuthData(
            $cos, $account
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ClearTwoFactorAuthDataRequest>'
                        . '<urn1:cos by="' . CosBy::NAME() . '">' . $value . '</urn1:cos>'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                    . '</urn1:ClearTwoFactorAuthDataRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
