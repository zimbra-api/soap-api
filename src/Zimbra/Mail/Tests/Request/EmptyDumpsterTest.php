<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\EmptyDumpster;

/**
 * Testcase class for EmptyDumpster.
 */
class EmptyDumpsterTest extends ZimbraMailApiTestCase
{
    public function testEmptyDumpsterRequest()
    {
        $req = new EmptyDumpster();

        $xml = '<?xml version="1.0"?>'."\n"
            .'<EmptyDumpsterRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'EmptyDumpsterRequest' => array(
                '_jsns' => 'urn:zimbraMail',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testEmptyDumpsterApi()
    {
        $this->api->emptyDumpster();

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:EmptyDumpsterRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
