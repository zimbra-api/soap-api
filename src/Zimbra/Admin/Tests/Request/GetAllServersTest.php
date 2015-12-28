<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetAllServers;

/**
 * Testcase class for GetAllServers.
 */
class GetAllServersTest extends ZimbraAdminApiTestCase
{
    public function testGetAllServersRequest()
    {
        $service = $this->faker->word;
        $req = new GetAllServers($service, false);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($service, $req->getService());
        $this->assertFalse($req->getApplyConfig());

        $req->setService($service)
            ->setApplyConfig(true);
        $this->assertSame($service, $req->getService());
        $this->assertTrue($req->getApplyConfig());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllServersRequest service="' . $service . '" applyConfig="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllServersRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'service' => $service,
                'applyConfig' => true,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllServersApi()
    {
        $service = $this->faker->word;
        $this->api->getAllServers($service, true);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllServersRequest service="' . $service . '" applyConfig="true" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
