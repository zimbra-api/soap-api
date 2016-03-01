<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\SyncGalAccount;
use Zimbra\Admin\Struct\SyncGalAccountDataSourceSpec;
use Zimbra\Admin\Struct\SyncGalAccountSpec;
use Zimbra\Enum\DataSourceBy;

/**
 * Testcase class for SyncGalAccount.
 */
class SyncGalAccountTest extends ZimbraAdminApiTestCase
{
    public function testSyncGalAccountRequest()
    {
        $id = $this->faker->word;
        $value = $this->faker->word;

        $ds = new SyncGalAccountDataSourceSpec(DataSourceBy::NAME(), $value, false, true);
        $account = new SyncGalAccountSpec($id, [$ds]);

        $req = new SyncGalAccount($account);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($account, $req->getAccount());
        $req->setAccount($account);
        $this->assertSame($account, $req->getAccount());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<SyncGalAccountRequest>'
                . '<account id="' . $id . '">'
                    . '<datasource by="' . DataSourceBy::NAME() . '" fullSync="false" reset="true">' . $value . '</datasource>'
                . '</account>'
            . '</SyncGalAccountRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'SyncGalAccountRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'account' => [
                    'id' => $id,
                    'datasource' => [
                        [
                            'by' => DataSourceBy::NAME()->value(),
                            'fullSync' => false,
                            'reset' => true,
                            '_content' => $value,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testSyncGalAccountApi()
    {
        $id = $this->faker->word;
        $value = $this->faker->word;

        $ds = new SyncGalAccountDataSourceSpec(DataSourceBy::NAME(), $value, false, true);
        $account = new SyncGalAccountSpec($id, [$ds]);

        $this->api->syncGalAccount(
            $account
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:SyncGalAccountRequest>'
                        . '<urn1:account id="' . $id . '">'
                            . '<urn1:datasource by="' . DataSourceBy::NAME() . '" fullSync="false" reset="true">' . $value . '</urn1:datasource>'
                        . '</urn1:account>'
                    . '</urn1:SyncGalAccountRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
