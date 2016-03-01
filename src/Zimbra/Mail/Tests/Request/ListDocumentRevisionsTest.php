<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\ListDocumentRevisions;
use Zimbra\Mail\Struct\ListDocumentRevisionsSpec;

/**
 * Testcase class for ListDocumentRevisions.
 */
class ListDocumentRevisionsTest extends ZimbraMailApiTestCase
{
    public function testListDocumentRevisionsRequest()
    {
        $id = $this->faker->uuid;
        $ver = mt_rand(1, 10);
        $count = mt_rand(1, 10);
        $doc = new ListDocumentRevisionsSpec(
            $id, $ver, $count
        );

        $req = new ListDocumentRevisions(
            $doc
        );
        $this->assertSame($doc, $req->getDoc());

        $req = new ListDocumentRevisions(
           new ListDocumentRevisionsSpec('', 0, 0)
        );
        $req->setDoc($doc);
        $this->assertSame($doc, $req->getDoc());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ListDocumentRevisionsRequest>'
                .'<doc id="' . $id . '" ver="' . $ver . '" count="' . $count . '" />'
            .'</ListDocumentRevisionsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ListDocumentRevisionsRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'doc' => array(
                    'id' => $id,
                    'ver' => $ver,
                    'count' => $count,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testListDocumentRevisionsApi()
    {
        $id = $this->faker->uuid;
        $ver = mt_rand(1, 10);
        $count = mt_rand(1, 10);
        $doc = new ListDocumentRevisionsSpec(
            $id, $ver, $count
        );
        $this->api->listDocumentRevisions(
            $doc
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ListDocumentRevisionsRequest>'
                        .'<urn1:doc id="' . $id . '" ver="' . $ver . '" count="' . $count . '" />'
                    .'</urn1:ListDocumentRevisionsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
