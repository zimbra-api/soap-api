<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\UnexpectedBlobInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for UnexpectedBlobInfo.
 */
class UnexpectedBlobInfoTest extends ZimbraStructTestCase
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

        $blob = new UnexpectedBlobInfo('', 0, 0, FALSE);
        $blob->setVolumeId($volumeId)
             ->setPath($path)
             ->setFileSize($fileSize)
             ->setExternal(TRUE);
        $this->assertSame($volumeId, $blob->getVolumeId());
        $this->assertSame($path, $blob->getPath());
        $this->assertSame($fileSize, $blob->getFileSize());
        $this->assertTrue($blob->getExternal());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<blob '
                . 'volumeId="' . $volumeId . '" '
                . 'path="' . $path . '" '
                . 'fileSize="' . $fileSize . '" '
                . 'external="true" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($blob, 'xml'));
        $this->assertEquals($blob, $this->serializer->deserialize($xml, UnexpectedBlobInfo::class, 'xml'));

        $json = json_encode([
            'volumeId' => $volumeId,
            'path' => $path,
            'fileSize' => $fileSize,
            'external' => TRUE,
        ]);
        $this->assertSame($json, $this->serializer->serialize($blob, 'json'));
        $this->assertEquals($blob, $this->serializer->deserialize($json, UnexpectedBlobInfo::class, 'json'));
    }
}
