<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GenerateUUID;

/**
 * Testcase class for GenerateUUID.
 */
class GenerateUUIDTest extends ZimbraMailApiTestCase
{
    public function testGenerateUUIDRequest()
    {
        $req = new GenerateUUID();
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GenerateUUIDRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GenerateUUIDRequest' => array(
                '_jsns' => 'urn:zimbraMail',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGenerateUUIDApi()
    {
        $this->api->generateUUID();

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GenerateUUIDRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
