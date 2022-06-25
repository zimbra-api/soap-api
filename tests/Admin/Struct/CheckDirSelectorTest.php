<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\CheckDirSelector;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CheckDirSelector.
 */
class CheckDirSelectorTest extends ZimbraTestCase
{
    public function testCheckDirSelector()
    {
        $path = $this->faker->word;
        $dir = new CheckDirSelector($path, FALSE);
        $this->assertSame($path, $dir->getPath());
        $this->assertFalse($dir->isCreate());

        $dir = new CheckDirSelector('', FALSE);
        $dir->setPath($path)
            ->setCreate(TRUE);
        $this->assertSame($path, $dir->getPath());
        $this->assertTrue($dir->isCreate());

        $xml = <<<EOT
<?xml version="1.0"?>
<result path="$path" create="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dir, 'xml'));
        $this->assertEquals($dir, $this->serializer->deserialize($xml, CheckDirSelector::class, 'xml'));
    }
}
