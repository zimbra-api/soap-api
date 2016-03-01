<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetSpellDictionaries;

/**
 * Testcase class for GetSpellDictionaries.
 */
class GetSpellDictionariesTest extends ZimbraMailApiTestCase
{
    public function testGetSpellDictionariesRequest()
    {
        $req = new GetSpellDictionaries();

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetSpellDictionariesRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetSpellDictionariesRequest' => array(
                '_jsns' => 'urn:zimbraMail',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetSpellDictionariesApi()
    {
        $this->api->getSpellDictionaries();

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetSpellDictionariesRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
