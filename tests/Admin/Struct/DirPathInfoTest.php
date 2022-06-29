<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\DirPathInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DirPathInfo.
 */
class DirPathInfoTest extends ZimbraTestCase
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

        $dir = new DirPathInfo();
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
<result path="$path" exists="true" isDirectory="true" readable="true" writable="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dir, 'xml'));
        $this->assertEquals($dir, $this->serializer->deserialize($xml, DirPathInfo::class, 'xml'));
    }
}
