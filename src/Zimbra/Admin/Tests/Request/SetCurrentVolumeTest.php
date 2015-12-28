<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\SetCurrentVolume;
use Zimbra\Enum\VolumeType;

/**
 * Testcase class for SetCurrentVolume.
 */
class SetCurrentVolumeTest extends ZimbraAdminApiTestCase
{
    public function testSetCurrentVolumeRequest()
    {
        $id = mt_rand(0, 100);
        $req = new SetCurrentVolume($id, VolumeType::PRIMARY());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals(1, $req->getType()->value());
        $req->setId($id)
            ->setType(VolumeType::SECONDARY());
        $this->assertEquals($id, $req->getId());
        $this->assertEquals(2, $req->getType()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<SetCurrentVolumeRequest '
                . 'id="' . $id . '" '
                . 'type="' . VolumeType::SECONDARY() . '" '
            . '/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'SetCurrentVolumeRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'type' => VolumeType::SECONDARY()->value(),
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testSetCurrentVolumeApi()
    {
        $id = mt_rand(0, 100);
        $this->api->setCurrentVolume(
            $id, VolumeType::SECONDARY()
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:SetCurrentVolumeRequest '
                        . 'id="' . $id . '" '
                        . 'type="' . VolumeType::SECONDARY() . '" '
                    . '/>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
