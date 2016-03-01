<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\DeleteGalSyncAccount;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;

/**
 * Testcase class for DeleteGalSyncAccount.
 */
class DeleteGalSyncAccountTest extends ZimbraAdminApiTestCase
{
    public function testDeleteGalSyncAccountRequest()
    {
        $value = $this->faker->word;
        $account = new AccountSelector(AccountBy::NAME(), $value);
        $req = new DeleteGalSyncAccount($account);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($account, $req->getAccount());

        $req->setAccount($account);
        $this->assertSame($account, $req->getAccount());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteGalSyncAccountRequest>'
                . '<account by="' . AccountBy::NAME() . '">' . $value  .'</account>'
            . '</DeleteGalSyncAccountRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteGalSyncAccountRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteGalSyncAccountApi()
    {
        $value = $this->faker->word;
        $account = new AccountSelector(AccountBy::NAME(), $value);

        $this->api->deleteGalSyncAccount(
            $account
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DeleteGalSyncAccountRequest>'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                    . '</urn1:DeleteGalSyncAccountRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
