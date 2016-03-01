<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetOutgoingFilterRules;

/**
 * Testcase class for GetOutgoingFilterRules.
 */
class GetOutgoingFilterRulesTest extends ZimbraMailApiTestCase
{
    public function testGetOutgoingFilterRulesRequest()
    {
        $req = new GetOutgoingFilterRules();
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetOutgoingFilterRulesRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetOutgoingFilterRulesRequest' => array(
                '_jsns' => 'urn:zimbraMail',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetOutgoingFilterRulesApi()
    {
        $this->api->getOutgoingFilterRules();

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetOutgoingFilterRulesRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
