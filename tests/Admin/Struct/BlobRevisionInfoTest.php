<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\BlobRevisionInfo;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for BlobRevisionInfo.
 */
class BlobRevisionInfoTest extends ZimbraStructTestCase
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

        $blob = new BlobRevisionInfo('', 0, 0, FALSE);
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
<blob path="$path" fileSize="$fileSize" rev="$revision" external="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($blob, 'xml'));
        $this->assertEquals($blob, $this->serializer->deserialize($xml, BlobRevisionInfo::class, 'xml'));

        $json = json_encode([
            'path' => $path,
            'fileSize' => $fileSize,
            'rev' => $revision,
            'external' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($blob, 'json'));
        $this->assertEquals($blob, $this->serializer->deserialize($json, BlobRevisionInfo::class, 'json'));
    }
}
