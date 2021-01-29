<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\BlobSizeInfo;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for BlobSizeInfo.
 */
class BlobSizeInfoTest extends ZimbraStructTestCase
{
    public function testBlobSizeInfo()
    {
        $path = $this->faker->word;
        $size = mt_rand(1, 100);
        $fileSize = mt_rand(1, 100);

        $blob = new BlobSizeInfo(
            $path, $size, $fileSize, FALSE
        );
        $this->assertSame($path, $blob->getPath());
        $this->assertSame($size, $blob->getSize());
        $this->assertSame($fileSize, $blob->getFileSize());
        $this->assertFalse($blob->getExternal());

        $blob = new BlobSizeInfo('', 0, 0, FALSE);
        $blob->setPath($path)
             ->setSize($size)
             ->setFileSize($fileSize)
             ->setExternal(TRUE);
        $this->assertSame($path, $blob->getPath());
        $this->assertSame($size, $blob->getSize());
        $this->assertSame($fileSize, $blob->getFileSize());
        $this->assertTrue($blob->getExternal());

        $xml = <<<EOT
<?xml version="1.0"?>
<blob path="$path" s="$size" fileSize="$fileSize" external="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($blob, 'xml'));
        $this->assertEquals($blob, $this->serializer->deserialize($xml, BlobSizeInfo::class, 'xml'));

        $json = json_encode([
            'path' => $path,
            's' => $size,
            'fileSize' => $fileSize,
            'external' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($blob, 'json'));
        $this->assertEquals($blob, $this->serializer->deserialize($json, BlobSizeInfo::class, 'json'));
    }
}
