<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\IncorrectBlobSizeInfo;
use Zimbra\Admin\Struct\BlobSizeInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for IncorrectBlobSizeInfo.
 */
class IncorrectBlobSizeInfoTest extends ZimbraTestCase
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

        $item = new StubIncorrectBlobSizeInfo(
            $id, $revision, $size, $volumeId, $blob
        );
        $this->assertSame($id, $item->getId());
        $this->assertSame($revision, $item->getRevision());
        $this->assertSame($size, $item->getSize());
        $this->assertSame($volumeId, $item->getVolumeId());
        $this->assertEquals($blob, $item->getBlob());

        $item = new StubIncorrectBlobSizeInfo();
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
<result id="$id" rev="$revision" s="$size" volumeId="$volumeId" xmlns:urn="urn:zimbraAdmin">
    <urn:blob path="$path" s="$size" fileSize="$fileSize" external="true" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($item, 'xml'));
        $this->assertEquals($item, $this->serializer->deserialize($xml, StubIncorrectBlobSizeInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubIncorrectBlobSizeInfo extends IncorrectBlobSizeInfo
{
}
