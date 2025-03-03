<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\VolumeExternalInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for VolumeExternalInfo.
 */
class VolumeExternalInfoTest extends ZimbraTestCase
{
    public function testVolumeExternalInfo()
    {
        $storageType = $this->faker->word;
        $volumePrefix = $this->faker->word;
        $globalBucketConfigId = $this->faker->word;
        $useInFrequentAccessThreshold = $this->faker->randomNumber;

        $info = new VolumeExternalInfo(
            $storageType, $volumePrefix, $globalBucketConfigId, FALSE, $useInFrequentAccessThreshold, FALSE, FALSE
        );
        $this->assertSame($storageType, $info->getStorageType());
        $this->assertSame($volumePrefix, $info->getVolumePrefix());
        $this->assertSame($globalBucketConfigId, $info->getGlobalBucketConfigurationId());
        $this->assertSame($useInFrequentAccessThreshold, $info->getUseInFrequentAccessThreshold());
        $this->assertFalse($info->isUseInFrequentAccess());
        $this->assertFalse($info->isUseIntelligentTiering());
        $this->assertFalse($info->isUnified());

        $info = new VolumeExternalInfo();
        $info->setStorageType($storageType)
             ->setVolumePrefix($volumePrefix)
             ->setGlobalBucketConfigurationId($globalBucketConfigId)
             ->setUseInFrequentAccessThreshold($useInFrequentAccessThreshold)
             ->setUseInFrequentAccess(TRUE)
             ->setUseIntelligentTiering(TRUE)
             ->setUnified(TRUE);
        $this->assertSame($storageType, $info->getStorageType());
        $this->assertSame($volumePrefix, $info->getVolumePrefix());
        $this->assertSame($globalBucketConfigId, $info->getGlobalBucketConfigurationId());
        $this->assertSame($useInFrequentAccessThreshold, $info->getUseInFrequentAccessThreshold());
        $this->assertTrue($info->isUseInFrequentAccess());
        $this->assertTrue($info->isUseIntelligentTiering());
        $this->assertTrue($info->isUnified());

        $xml = <<<EOT
<?xml version="1.0"?>
<result storageType="$storageType" volumePrefix="$volumePrefix" globalBucketConfigId="$globalBucketConfigId" useInFrequentAccess="true" useInFrequentAccessThreshold="$useInFrequentAccessThreshold" useIntelligentTiering="true" unified="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, VolumeExternalInfo::class, 'xml'));
    }
}
