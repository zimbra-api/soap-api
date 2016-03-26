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
        $clusterId = $this->faker->uuid;

        $req = new GetAllServers($service, $clusterId, false);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($service, $req->getService());
        $this->assertSame($clusterId, $req->getAlwaysOnClusterId());
        $this->assertFalse($req->getApplyConfig());

        $req->setService($service)
            ->setAlwaysOnClusterId($clusterId)
            ->setApplyConfig(true);
        $this->assertSame($service, $req->getService());
        $this->assertSame($clusterId, $req->getAlwaysOnClusterId());
        $this->assertTrue($req->getApplyConfig());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllServersRequest service="' . $service . '" alwaysOnClusterId="' . $clusterId . '" applyConfig="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllServersRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'service' => $service,
                'alwaysOnClusterId' => $clusterId,
                'applyConfig' => true,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllServersApi()
    {
        $service = $this->faker->word;
        $clusterId = $this->faker->uuid;
        $this->api->getAllServers($service, $clusterId, true);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllServersRequest service="' . $service . '" alwaysOnClusterId="' . $clusterId . '" applyConfig="true" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
