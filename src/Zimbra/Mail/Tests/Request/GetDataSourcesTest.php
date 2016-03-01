<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetDataSources;

/**
 * Testcase class for GetDataSources.
 */
class MailGetDataSourcesTest extends ZimbraMailApiTestCase
{
    public function testGetDataSourcesRequest()
    {
        $req = new GetDataSources();
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetDataSourcesRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetDataSourcesRequest' => array(
                '_jsns' => 'urn:zimbraMail',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetDataSourcesApi()
    {
        $this->api->getDataSources();

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetDataSourcesRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
