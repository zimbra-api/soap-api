<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\ModifyVolume;
use Zimbra\Admin\Struct\VolumeInfo;
use Zimbra\Enum\VolumeType;

/**
 * Testcase class for ModifyVolume.
 */
class ModifyVolumeTest extends ZimbraAdminApiTestCase
{
    public function testModifyVolumeRequest()
    {
        $id = mt_rand(0, 100);
        $type = $this->faker->randomElement(VolumeType::enums());
        $threshold = mt_rand(0, 10);
        $mgbits = mt_rand(0, 10);
        $mbits = mt_rand(0, 10);
        $fgbits = mt_rand(0, 10);
        $fbits = mt_rand(0, 10);
        $name = $this->faker->word;
        $rootpath = $this->faker->word;

        $volume = new VolumeInfo(
            $id, $type, $threshold, $mgbits, $mbits, $fgbits, $fbits, $name, $rootpath, false, true
        );
        $req = new ModifyVolume($id, $volume);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($id, $req->getId());
        $this->assertSame($volume, $req->getVolume());

        $req->setId($id)
            ->setVolume($volume);
        $this->assertSame($id, $req->getId());
        $this->assertSame($volume, $req->getVolume());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyVolumeRequest id="' . $id . '">'
                . '<volume '
                    . 'id="' . $id . '" '
                    . 'type="' . $type . '" '
                    . 'compressionThreshold="' . $threshold . '" '
                    . 'mgbits="' . $mgbits . '" '
                    . 'mbits="' . $mbits . '" '
                    . 'fgbits="' . $fgbits . '" '
                    . 'fbits="' . $fbits . '" '
                    . 'name="' . $name . '" '
                    . 'rootpath="' . $rootpath . '" '
                    . 'compressBlobs="false" '
                    . 'isCurrent="true" />'
            . '</ModifyVolumeRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyVolumeRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'volume' => [
                    'id' => $id,
                    'type' => $type,
                    'compressionThreshold' => $threshold,
                    'mgbits' => $mgbits,
                    'mbits' => $mbits,
                    'fgbits' => $fgbits,
                    'fbits' => $fbits,
                    'name' => $name,
                    'rootpath' => $rootpath,
                    'compressBlobs' => false,
                    'isCurrent' => true,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyVolumeApi()
    {
        $id = mt_rand(0, 100);
        $type = $this->faker->randomElement(VolumeType::enums());
        $threshold = mt_rand(0, 10);
        $mgbits = mt_rand(0, 10);
        $mbits = mt_rand(0, 10);
        $fgbits = mt_rand(0, 10);
        $fbits = mt_rand(0, 10);
        $name = $this->faker->word;
        $rootpath = $this->faker->word;

        $volume = new VolumeInfo(
            $id, $type, $threshold, $mgbits, $mbits, $fgbits, $fbits, $name, $rootpath, false, true
        );

        $this->api->modifyVolume(
            $id, $volume
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ModifyVolumeRequest id="' . $id . '">'
                        . '<urn1:volume '
                            . 'id="' . $id . '" '
                            . 'type="' . $type . '" '
                            . 'compressionThreshold="' . $threshold . '" '
                            . 'mgbits="' . $mgbits . '" '
                            . 'mbits="' . $mbits . '" '
                            . 'fgbits="' . $fgbits . '" '
                            . 'fbits="' . $fbits . '" '
                            . 'name="' . $name . '" '
                            . 'rootpath="' . $rootpath . '" '
                            . 'compressBlobs="false" '
                            . 'isCurrent="true" />'
                    . '</urn1:ModifyVolumeRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
