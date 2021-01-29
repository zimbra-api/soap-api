<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\IncorrectBlobRevisionInfo;
use Zimbra\Admin\Struct\BlobRevisionInfo;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for IncorrectBlobRevisionInfo.
 */
class IncorrectBlobRevisionInfoTest extends ZimbraStructTestCase
{
    public function testIncorrectBlobRevisionInfo()
    {
        $path = $this->faker->word;
        $size = mt_rand(1, 100);
        $fileSize = mt_rand(1, 100);
        $id = mt_rand(1, 100);
        $revision = mt_rand(1, 100);
        $volumeId = mt_rand(1, 100);

        $blob = new BlobRevisionInfo(
            $path, $fileSize, $revision, TRUE
        );

        $item = new IncorrectBlobRevisionInfo(
            $id, $revision, $size, $volumeId, $blob
        );
        $this->assertSame($id, $item->getId());
        $this->assertSame($revision, $item->getRevision());
        $this->assertSame($size, $item->getSize());
        $this->assertSame($volumeId, $item->getVolumeId());
        $this->assertEquals($blob, $item->getBlob());

        $item = new IncorrectBlobRevisionInfo(0, 0, 0, 0, new BlobRevisionInfo('', 0, 0, FALSE));
        $item->setId($id)
              ->setRevision($revision)
              ->setSize($size)
              ->setVolumeId($volumeId)
              ->setBlob($blob);
        $this->assertSame($id, $item->getId());
        $this->assertSame($revision, $item->getRevision());
        $this->assertSame($size, $item->getSize());
        $this->assertSame($volumeId, $item->getVolumeId());
        $this->assertEquals($blob, $item->getBlob());

        $xml = <<<EOT
<?xml version="1.0"?>
<item id="$id" rev="$revision" s="$size" volumeId="$volumeId">
    <blob path="$path" fileSize="$fileSize" rev="$revision" external="true" />
</item>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($item, 'xml'));
        $this->assertEquals($item, $this->serializer->deserialize($xml, IncorrectBlobRevisionInfo::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'rev' => $revision,
            's' => $size,
            'volumeId' => $volumeId,
            'blob' => [
                'path' => $path,
                'fileSize' => $fileSize,
                'rev' => $revision,
                'external' => TRUE,
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($item, 'json'));
        $this->assertEquals($item, $this->serializer->deserialize($json, IncorrectBlobRevisionInfo::class, 'json'));
    }
}
