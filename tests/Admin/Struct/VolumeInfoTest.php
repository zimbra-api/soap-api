<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\VolumeInfo;
use Zimbra\Admin\Struct\VolumeExternalInfo;
use Zimbra\Admin\Struct\VolumeExternalOpenIOInfo;
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
        $type = $this->faker->randomElement(VolumeType::cases());
        $threshold = mt_rand(0, 10);
        $mgbits = mt_rand(0, 10);
        $mbits = mt_rand(0, 10);
        $fgbits = mt_rand(0, 10);
        $fbits = mt_rand(0, 10);
        $name = $this->faker->word;
        $rootPath = $this->faker->word;
        $storeType = mt_rand(1, 2);
        $storeManagerClass = $this->faker->word;

        $storageType = $this->faker->word;
        $volumePrefix = $this->faker->word;
        $globalBucketConfigId = $this->faker->word;
        $useInFrequentAccessThreshold = $this->faker->randomNumber;
        $url = $this->faker->word;
        $account = $this->faker->word;
        $nameSpace = $this->faker->word;
        $proxyPort = $this->faker->randomNumber;
        $accountPort = $this->faker->randomNumber;

        $s3 = new VolumeExternalInfo(
            $storageType, $volumePrefix, $globalBucketConfigId, TRUE, $useInFrequentAccessThreshold, TRUE
        );
        $openio = new VolumeExternalOpenIOInfo(
            $storageType, $url, $account, $nameSpace, $proxyPort, $accountPort
        );

        $volume = new StubVolumeInfo(
            $id, $name, $rootPath, $type, FALSE, $threshold, $mgbits, $mbits, $fgbits, $fbits, TRUE, TRUE, $storeType, $storeManagerClass, $s3, $openio
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
        $this->assertSame($s3, $volume->getVolumeExternalInfo());
        $this->assertSame($openio, $volume->getVolumeExternalOpenIOInfo());

        $volume = new StubVolumeInfo();
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
               ->setStoreManagerClass($storeManagerClass)
               ->setVolumeExternalInfo($s3)
               ->setVolumeExternalOpenIOInfo($openio);
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
        $this->assertSame($s3, $volume->getVolumeExternalInfo());
        $this->assertSame($openio, $volume->getVolumeExternalOpenIOInfo());

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraAdmin" id="$id" name="$name" rootpath="$rootPath" type="$type" compressBlobs="true" compressionThreshold="$threshold" mgbits="$mgbits" mbits="$mbits" fgbits="$fgbits" fbits="$fbits" isCurrent="false" current="false" storeType="$storeType" storeManagerClass="$storeManagerClass">
    <urn:volumeExternalInfo storageType="$storageType" volumePrefix="$volumePrefix" globalBucketConfigId="$globalBucketConfigId" useInFrequentAccess="true" useInFrequentAccessThreshold="$useInFrequentAccessThreshold" useIntelligentTiering="true" />
    <urn:volumeExternalOpenIOInfo storageType="$storageType" url="$url" account="$account" namespace="$nameSpace" proxyPort="$proxyPort" accountPort="$accountPort" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($volume, 'xml'));
        $this->assertEquals($volume, $this->serializer->deserialize($xml, StubVolumeInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubVolumeInfo extends VolumeInfo
{
}
