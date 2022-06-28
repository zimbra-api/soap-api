<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\VolumeIdAndProgress;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for VolumeIdAndProgress.
 */
class VolumeIdAndProgressTest extends ZimbraTestCase
{
    public function testVolumeIdAndProgress()
    {
        $volumeId = $this->faker->word;
        $progress = $this->faker->word;

        $volumeProgress = new VolumeIdAndProgress($volumeId, $progress);
        $this->assertSame($volumeId, $volumeProgress->getVolumeId());
        $this->assertSame($progress, $volumeProgress->getProgress());
        $volumeProgress = new VolumeIdAndProgress();
        $volumeProgress->setVolumeId($volumeId)
            ->setProgress($progress);
        $this->assertSame($volumeId, $volumeProgress->getVolumeId());
        $this->assertSame($progress, $volumeProgress->getProgress());

        $xml = <<<EOT
<?xml version="1.0"?>
<result volumeId="$volumeId" progress="$progress" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($volumeProgress, 'xml'));
        $this->assertEquals($volumeProgress, $this->serializer->deserialize($xml, VolumeIdAndProgress::class, 'xml'));
    }
}
