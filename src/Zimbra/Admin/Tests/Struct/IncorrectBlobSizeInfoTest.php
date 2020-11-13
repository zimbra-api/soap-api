<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\IncorrectBlobSizeInfo;
use Zimbra\Admin\Struct\BlobSizeInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for IncorrectBlobSizeInfo.
 */
class IncorrectBlobSizeInfoTest extends ZimbraStructTestCase
{
    public function testIncorrectBlobSizeInfo()
    {
        $path = $this->faker->word;
        $size = mt_rand(1, 100);
        $fileSize = mt_rand(1, 100);
        $id = mt_rand(1, 100);
        $revision = mt_rand(1, 100);
        $volumeId = mt_rand(1, 100);

        $blob = new BlobSizeInfo(
            $path, $size, $fileSize, TRUE
        );

        $item = new IncorrectBlobSizeInfo(
            $id, $revision, $size, $volumeId, $blob
        );
        $this->assertSame($id, $item->getId());
        $this->assertSame($revision, $item->getRevision());
        $this->assertSame($size, $item->getSize());
        $this->assertSame($volumeId, $item->getVolumeId());
        $this->assertEquals($blob, $item->getBlob());

        $item = new IncorrectBlobSizeInfo(0, 0, 0, 0, new BlobSizeInfo('', 0, 0, FALSE));
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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<item id="' . $id . '" rev="' . $revision . '" s="' . $size . '" volumeId="' . $volumeId . '">'
                . '<blob path="' . $path . '" s="' . $size . '" fileSize="' . $fileSize . '" external="true" />'
            . '</item>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($item, 'xml'));
        $this->assertEquals($item, $this->serializer->deserialize($xml, IncorrectBlobSizeInfo::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'rev' => $revision,
            's' => $size,
            'volumeId' => $volumeId,
            'blob' => [
                'path' => $path,
                's' => $size,
                'fileSize' => $fileSize,
                'external' => TRUE,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($item, 'json'));
        $this->assertEquals($item, $this->serializer->deserialize($json, IncorrectBlobSizeInfo::class, 'json'));
    }
}
