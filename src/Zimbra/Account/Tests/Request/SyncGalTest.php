<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\SyncGal;

/**
 * Testcase class for SyncGal.
 */
class SyncGalTest extends ZimbraAccountApiTestCase
{
    public function testSyncGalRequest()
    {
        $token = $this->faker->word;
        $galAcctId = $this->faker->word;

        $req = new SyncGal($token, $galAcctId, false);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($token, $req->getToken());
        $this->assertSame($galAcctId, $req->getGalAccountId());
        $this->assertFalse($req->getIdOnly());

        $req->setGalAccountId($token)
            ->setGalAccountId($galAcctId)
            ->setIdOnly(true);
        $this->assertSame($token, $req->getToken());
        $this->assertSame($galAcctId, $req->getGalAccountId());
        $this->assertTrue($req->getIdOnly());


        $xml = '<?xml version="1.0"?>' . "\n"
            . '<SyncGalRequest token="' . $token . '" galAcctId="' . $galAcctId . '" idOnly="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'SyncGalRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'token' => $token,
                'galAcctId' => $galAcctId,
                'idOnly' => true,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testSyncGalApi()
    {
        $token = $this->faker->word;
        $galAcctId = $this->faker->word;
        $this->api->syncGal($token, $galAcctId, true);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:SyncGalRequest token="' . $token . '" galAcctId="' . $galAcctId . '" idOnly="true" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
