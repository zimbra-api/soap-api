<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\PurgeRevision;
use Zimbra\Mail\Struct\PurgeRevisionSpec;

/**
 * Testcase class for PurgeRevision.
 */
class PurgeRevisionTest extends ZimbraMailApiTestCase
{
    public function testPurgeRevisionRequest()
    {
        $id = $this->faker->uuid;
        $ver = mt_rand(1, 10);
        $revision = new PurgeRevisionSpec(
            $id, $ver, true
        );

        $req = new PurgeRevision(
            $revision
        );
        $this->assertSame($revision, $req->getRevision());

        $req = new PurgeRevision(
            new PurgeRevisionSpec('', 0)
        );
        $req->setRevision($revision);
        $this->assertSame($revision, $req->getRevision());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<PurgeRevisionRequest>'
                .'<revision id="' . $id . '" ver="' . $ver . '" includeOlderRevisions="true" />'
            .'</PurgeRevisionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'PurgeRevisionRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'revision' => array(
                    'id' => $id,
                    'ver' => $ver,
                    'includeOlderRevisions' => true,
                )
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testPurgeRevisionApi()
    {
        $id = $this->faker->uuid;
        $ver = mt_rand(1, 10);
        $revision = new PurgeRevisionSpec(
            $id, $ver, true
        );
        $this->api->purgeRevision(
            $revision
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:PurgeRevisionRequest>'
                        .'<urn1:revision id="' . $id . '" ver="' . $ver . '" includeOlderRevisions="true" />'
                    .'</urn1:PurgeRevisionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
