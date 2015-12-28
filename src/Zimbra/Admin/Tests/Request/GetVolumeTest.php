<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetVolume;

/**
 * Testcase class for GetVolume.
 */
class GetVolumeTest extends ZimbraAdminApiTestCase
{
    public function testGetVolumeRequest()
    {
        $id = mt_rand(0, 100);
        $req = new GetVolume($id);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($id, $req->getId());
        $req->setId($id);
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetVolumeRequest id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetVolumeRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetVolumeApi()
    {
        $id = mt_rand(0, 100);
        $this->api->getVolume($id);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetVolumeRequest id="' . $id . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
