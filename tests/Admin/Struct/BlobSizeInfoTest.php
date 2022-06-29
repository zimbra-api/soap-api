<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\BlobSizeInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for BlobSizeInfo.
 */
class BlobSizeInfoTest extends ZimbraTestCase
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

        $blob = new BlobSizeInfo();
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
<result path="$path" s="$size" fileSize="$fileSize" external="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($blob, 'xml'));
        $this->assertEquals($blob, $this->serializer->deserialize($xml, BlobSizeInfo::class, 'xml'));
    }
}
