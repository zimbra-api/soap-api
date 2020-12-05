<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\DirPathInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for DirPathInfo.
 */
class DirPathInfoTest extends ZimbraStructTestCase
{
    public function testDirPathInfo()
    {
        $path = $this->faker->word;
        $dir = new DirPathInfo($path, FALSE, FALSE, FALSE, FALSE);
        $this->assertSame($path, $dir->getPath());
        $this->assertFalse($dir->isExists());
        $this->assertFalse($dir->isDirectory());
        $this->assertFalse($dir->isReadable());
        $this->assertFalse($dir->isWritable());

        $dir = new DirPathInfo('', FALSE, FALSE, FALSE, FALSE);
        $dir->setPath($path)
            ->setExists(TRUE)
            ->setIsDirectory(TRUE)
            ->setReadable(TRUE)
            ->setWritable(TRUE);
        $this->assertSame($path, $dir->getPath());
        $this->assertTrue($dir->isExists());
        $this->assertTrue($dir->isDirectory());
        $this->assertTrue($dir->isReadable());
        $this->assertTrue($dir->isWritable());

        $xml = <<<EOT
<?xml version="1.0"?>
<directory path="$path" exists="true" isDirectory="true" readable="true" writable="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dir, 'xml'));
        $this->assertEquals($dir, $this->serializer->deserialize($xml, DirPathInfo::class, 'xml'));

        $json = json_encode([
            'path' => $path,
            'exists' => TRUE,
            'isDirectory' => TRUE,
            'readable' => TRUE,
            'writable' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($dir, 'json'));
        $this->assertEquals($dir, $this->serializer->deserialize($json, DirPathInfo::class, 'json'));
    }
}
