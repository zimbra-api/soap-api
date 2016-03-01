<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\DeleteVolume;

/**
 * Testcase class for DeleteVolume.
 */
class DeleteVolumeTest extends ZimbraAdminApiTestCase
{
    public function testDeleteVolumeRequest()
    {
        $id = mt_rand(0, 100);
        $req = new DeleteVolume($id);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($id, $req->getId());

        $req->setId($id);
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteVolumeRequest id="' . $id  .'" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteVolumeRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteVolumeApi()
    {
        $id = mt_rand(0, 100);
        $this->api->deleteVolume(
            $id
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DeleteVolumeRequest id="' . $id . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
