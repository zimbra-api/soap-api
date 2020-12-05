<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\MissingBlobInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for MissingBlobInfo.
 */
class MissingBlobInfoTest extends ZimbraStructTestCase
{
    public function testMissingBlobInfo()
    {
        $id = mt_rand(1, 100);
        $revision = mt_rand(1, 100);
        $size = mt_rand(1, 100);
        $volumeId = mt_rand(1, 100);
        $blobPath = $this->faker->word;
        $version = mt_rand(1, 100);

        $item = new MissingBlobInfo(
            $id, $revision, $size, $volumeId, $blobPath, FALSE, $version
        );
        $this->assertSame($id, $item->getId());
        $this->assertSame($revision, $item->getRevision());
        $this->assertSame($size, $item->getSize());
        $this->assertSame($volumeId, $item->getVolumeId());
        $this->assertSame($blobPath, $item->getBlobPath());
        $this->assertFalse($item->getExternal());
        $this->assertSame($version, $item->getVersion());

        $item = new MissingBlobInfo(0, 0, 0, 0, '', FALSE, 0);
        $item->setId($id)
             ->setRevision($revision)
             ->setSize($size)
             ->setVolumeId($volumeId)
             ->setBlobPath($blobPath)
             ->setExternal(TRUE)
             ->setVersion($version);
        $this->assertSame($id, $item->getId());
        $this->assertSame($revision, $item->getRevision());
        $this->assertSame($size, $item->getSize());
        $this->assertSame($volumeId, $item->getVolumeId());
        $this->assertSame($blobPath, $item->getBlobPath());
        $this->assertTrue($item->getExternal());
        $this->assertSame($version, $item->getVersion());

        $xml = <<<EOT
<?xml version="1.0"?>
<item id="$id" rev="$revision" s="$size" volumeId="$volumeId" blobPath="$blobPath" external="true" version="$version" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($item, 'xml'));
        $this->assertEquals($item, $this->serializer->deserialize($xml, MissingBlobInfo::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'rev' => $revision,
            's' => $size,
            'volumeId' => $volumeId,
            'blobPath' => $blobPath,
            'external' => TRUE,
            'version' => $version,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($item, 'json'));
        $this->assertEquals($item, $this->serializer->deserialize($json, MissingBlobInfo::class, 'json'));
    }
}
