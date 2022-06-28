<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\UnexpectedBlobInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for UnexpectedBlobInfo.
 */
class UnexpectedBlobInfoTest extends ZimbraTestCase
{
    public function testUnexpectedBlobInfo()
    {
        $volumeId = mt_rand(1, 100);
        $path = $this->faker->word;
        $fileSize = mt_rand(1, 100);

        $blob = new UnexpectedBlobInfo(
            $volumeId, $path, $fileSize, FALSE
        );
        $this->assertSame($volumeId, $blob->getVolumeId());
        $this->assertSame($path, $blob->getPath());
        $this->assertSame($fileSize, $blob->getFileSize());
        $this->assertFalse($blob->getExternal());

        $blob = new UnexpectedBlobInfo();
        $blob->setVolumeId($volumeId)
             ->setPath($path)
             ->setFileSize($fileSize)
             ->setExternal(TRUE);
        $this->assertSame($volumeId, $blob->getVolumeId());
        $this->assertSame($path, $blob->getPath());
        $this->assertSame($fileSize, $blob->getFileSize());
        $this->assertTrue($blob->getExternal());

        $xml = <<<EOT
<?xml version="1.0"?>
<result volumeId="$volumeId" path="$path" fileSize="$fileSize" external="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($blob, 'xml'));
        $this->assertEquals($blob, $this->serializer->deserialize($xml, UnexpectedBlobInfo::class, 'xml'));
    }
}
