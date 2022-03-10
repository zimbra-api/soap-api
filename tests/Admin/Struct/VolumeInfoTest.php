<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\VolumeInfo;
use Zimbra\Enum\VolumeType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for VolumeInfo.
 */
class VolumeInfoTest extends ZimbraTestCase
{
    public function testVolumeInfo()
    {
        $id = mt_rand(0, 10);
        $type = $this->faker->randomElement(VolumeType::toArray());
        $threshold = mt_rand(0, 10);
        $mgbits = mt_rand(0, 10);
        $mbits = mt_rand(0, 10);
        $fgbits = mt_rand(0, 10);
        $fbits = mt_rand(0, 10);
        $name = $this->faker->word;
        $rootPath = $this->faker->word;

        $volume = new VolumeInfo(
            $id, $name, $rootPath, $type, FALSE, $threshold, $mgbits, $mbits, $fgbits, $fbits, TRUE
        );
        $this->assertSame($id, $volume->getId());
        $this->assertSame($type, $volume->getType());
        $this->assertSame($threshold, $volume->getCompressionThreshold());
        $this->assertSame($mgbits, $volume->getMgbits());
        $this->assertSame($mbits, $volume->getMbits());
        $this->assertSame($fgbits, $volume->getFgbits());
        $this->assertSame($fbits, $volume->getFbits());
        $this->assertSame($name, $volume->getName());
        $this->assertSame($rootPath, $volume->getRootPath());
        $this->assertFalse($volume->getCompressBlobs());
        $this->assertTrue($volume->isCurrent());

        $volume = new VolumeInfo();
        $volume->setId($id)
               ->setType($type)
               ->setCompressionThreshold($threshold)
               ->setMgbits($mgbits)
               ->setMbits($mbits)
               ->setFgbits($fgbits)
               ->setFbits($fbits)
               ->setName($name)
               ->setrootPath($rootPath)
               ->setCompressBlobs(TRUE)
               ->setCurrent(FALSE);
        $this->assertSame($id, $volume->getId());
        $this->assertSame($type, $volume->getType());
        $this->assertSame($threshold, $volume->getCompressionThreshold());
        $this->assertSame($mgbits, $volume->getMgbits());
        $this->assertSame($mbits, $volume->getMbits());
        $this->assertSame($fgbits, $volume->getFgbits());
        $this->assertSame($fbits, $volume->getFbits());
        $this->assertSame($name, $volume->getName());
        $this->assertSame($rootPath, $volume->getRootPath());
        $this->assertTrue($volume->getCompressBlobs());
        $this->assertFalse($volume->isCurrent());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" name="$name" rootpath="$rootPath" type="$type" compressBlobs="true" compressionThreshold="$threshold" mgbits="$mgbits" mbits="$mbits" fgbits="$fgbits" fbits="$fbits" isCurrent="false" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($volume, 'xml'));
        $this->assertEquals($volume, $this->serializer->deserialize($xml, VolumeInfo::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'name' => $name,
            'rootpath' => $rootPath,
            'type' => $type,
            'compressBlobs' => TRUE,
            'compressionThreshold' => $threshold,
            'mgbits' => $mgbits,
            'mbits' => $mbits,
            'fgbits' => $fgbits,
            'fbits' => $fbits,
            'isCurrent' => FALSE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($volume, 'json'));
        $this->assertEquals($volume, $this->serializer->deserialize($json, VolumeInfo::class, 'json'));
    }
}
