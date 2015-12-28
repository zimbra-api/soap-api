<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\VolumeInfo;
use Zimbra\Enum\VolumeType;

/**
 * Testcase class for VolumeInfo.
 */
class VolumeInfoTest extends ZimbraAdminTestCase
{
    public function testVolumeInfo()
    {
        $id = mt_rand(0, 10);
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
        $this->assertSame($id, $volume->getId());
        $this->assertSame($type, $volume->getType());
        $this->assertSame($threshold, $volume->getCompressionThreshold());
        $this->assertSame($mgbits, $volume->getMgbits());
        $this->assertSame($mbits, $volume->getMbits());
        $this->assertSame($fgbits, $volume->getFgbits());
        $this->assertSame($fbits, $volume->getFbits());
        $this->assertSame($name, $volume->getName());
        $this->assertSame($rootpath, $volume->getRootPath());
        $this->assertFalse($volume->getCompressBlobs());
        $this->assertTrue($volume->isCurrent());

        $volume->setId($id)
               ->setType($type)
               ->setCompressionThreshold($threshold)
               ->setMgbits($mgbits)
               ->setMbits($mbits)
               ->setFgbits($fgbits)
               ->setFbits($fbits)
               ->setName($name)
               ->setRootPath($rootpath)
               ->setCompressBlobs(true)
               ->setCurrent(false);
        $this->assertSame($id, $volume->getId());
        $this->assertSame($type, $volume->getType());
        $this->assertSame($threshold, $volume->getCompressionThreshold());
        $this->assertSame($mgbits, $volume->getMgbits());
        $this->assertSame($mbits, $volume->getMbits());
        $this->assertSame($fgbits, $volume->getFgbits());
        $this->assertSame($fbits, $volume->getFbits());
        $this->assertSame($name, $volume->getName());
        $this->assertSame($rootpath, $volume->getRootPath());
        $this->assertTrue($volume->getCompressBlobs());
        $this->assertFalse($volume->isCurrent());

        $xml = '<?xml version="1.0"?>' . "\n"
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
                . 'compressBlobs="true" '
                . 'isCurrent="false" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $volume);

        $array = [
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
                'compressBlobs' => true,
                'isCurrent' => false,
            ],
        ];
        $this->assertEquals($array, $volume->toArray());
    }
}
