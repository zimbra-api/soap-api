<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\Sync;

/**
 * Testcase class for Sync.
 */
class SyncTest extends ZimbraMailApiTestCase
{
    public function testSyncRequest()
    {
        $token = $this->faker->word;
        $l = $this->faker->word;
        $calCutoff = mt_rand(1, 10);

        $req = new Sync(
            $token, $calCutoff, $l, true
        );
        $this->assertSame($token, $req->getToken());
        $this->assertSame($calCutoff, $req->getCalendarCutoff());
        $this->assertSame($l, $req->getFolderId());
        $this->assertTrue($req->getTypedDeletes());

        $req = new Sync();
        $req->setToken($token)
            ->setCalendarCutoff($calCutoff)
            ->setFolderId($l)
            ->setTypedDeletes(true);
        $this->assertSame($token, $req->getToken());
        $this->assertSame($calCutoff, $req->getCalendarCutoff());
        $this->assertSame($l, $req->getFolderId());
        $this->assertTrue($req->getTypedDeletes());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SyncRequest token="' . $token . '" calCutoff="' . $calCutoff . '" l="' . $l . '" typed="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SyncRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'token' => $token,
                'calCutoff' => $calCutoff,
                'l' => $l,
                'typed' => true,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSyncApi()
    {
        $token = $this->faker->word;
        $l = $this->faker->word;
        $calCutoff = mt_rand(1, 10);

        $this->api->sync($token, $calCutoff, $l, true);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:SyncRequest token="' . $token . '" calCutoff="' . $calCutoff . '" l="' . $l . '" typed="true" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
