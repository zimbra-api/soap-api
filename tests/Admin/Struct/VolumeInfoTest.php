<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\VolumeInfo;
use Zimbra\Common\Enum\VolumeType;
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
        $storeType = mt_rand(1, 2);
        $storeManagerClass = $this->faker->word;

        $volume = new VolumeInfo(
            $id, $name, $rootPath, $type, FALSE, $threshold, $mgbits, $mbits, $fgbits, $fbits, TRUE, TRUE, $storeType, $storeManagerClass
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
        $this->assertTrue($volume->getIsCurrent());
        $this->assertTrue($volume->getCurrent());
        $this->assertSame($storeType, $volume->getStoreType());
        $this->assertSame($storeManagerClass, $volume->getStoreManagerClass());

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
               ->setIsCurrent(FALSE)
               ->setCurrent(FALSE)
               ->setStoreType($storeType)
               ->setStoreManagerClass($storeManagerClass);
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
        $this->assertFalse($volume->getIsCurrent());
        $this->assertFalse($volume->getCurrent());
        $this->assertSame($storeType, $volume->getStoreType());
        $this->assertSame($storeManagerClass, $volume->getStoreManagerClass());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" name="$name" rootpath="$rootPath" type="$type" compressBlobs="true" compressionThreshold="$threshold" mgbits="$mgbits" mbits="$mbits" fgbits="$fgbits" fbits="$fbits" isCurrent="false" current="false" storeType="$storeType" storeManagerClass="$storeManagerClass" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($volume, 'xml'));
        $this->assertEquals($volume, $this->serializer->deserialize($xml, VolumeInfo::class, 'xml'));
    }
}
