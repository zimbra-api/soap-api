<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\BlobRevisionInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for BlobRevisionInfo.
 */
class BlobRevisionInfoTest extends ZimbraTestCase
{
    public function testBlobRevisionInfo()
    {
        $path = $this->faker->word;
        $fileSize = mt_rand(1, 100);
        $revision = mt_rand(1, 100);

        $blob = new BlobRevisionInfo(
            $path, $fileSize, $revision, FALSE
        );
        $this->assertSame($path, $blob->getPath());
        $this->assertSame($fileSize, $blob->getFileSize());
        $this->assertSame($revision, $blob->getRevision());
        $this->assertFalse($blob->getExternal());

        $blob = new BlobRevisionInfo();
        $blob->setPath($path)
             ->setRevision($revision)
             ->setFileSize($fileSize)
             ->setExternal(TRUE);
        $this->assertSame($path, $blob->getPath());
        $this->assertSame($fileSize, $blob->getFileSize());
        $this->assertSame($revision, $blob->getRevision());
        $this->assertTrue($blob->getExternal());

        $xml = <<<EOT
<?xml version="1.0"?>
<result path="$path" fileSize="$fileSize" rev="$revision" external="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($blob, 'xml'));
        $this->assertEquals($blob, $this->serializer->deserialize($xml, BlobRevisionInfo::class, 'xml'));
    }
}
