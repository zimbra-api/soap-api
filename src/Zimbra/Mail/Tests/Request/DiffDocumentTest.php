<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\DiffDocument;
use Zimbra\Mail\Struct\DiffDocumentVersionSpec;

/**
 * Testcase class for DiffDocument.
 */
class DiffDocumentTest extends ZimbraMailApiTestCase
{
    public function testDiffDocumentRequest()
    {
        $id = $this->faker->uuid;
        $v1 = mt_rand(1, 10);
        $v2 = mt_rand(1, 10);
        $doc = new DiffDocumentVersionSpec($id, $v1, $v2);

        $req = new DiffDocument(
            $doc
        );
        $this->assertSame($doc, $req->getDoc());
        $req->setDoc($doc);
        $this->assertSame($doc, $req->getDoc());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DiffDocumentRequest>'
                .'<doc id="' . $id . '" v1="' . $v1 . '" v2="' . $v2 . '" />'
            .'</DiffDocumentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DiffDocumentRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'doc' => array(
                    'id' => $id,
                    'v1' => $v1,
                    'v2' => $v2,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDiffDocumentApi()
    {
        $id = $this->faker->uuid;
        $v1 = mt_rand(1, 10);
        $v2 = mt_rand(1, 10);
        $doc = new DiffDocumentVersionSpec($id, $v1, $v2);
        $this->api->diffDocument(
            $doc
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:DiffDocumentRequest>'
                        .'<urn1:doc id="' . $id . '" v1="' . $v1 . '" v2="' . $v2 . '" />'
                    .'</urn1:DiffDocumentRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
