<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\CheckDirSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckDirSelector.
 */
class CheckDirSelectorTest extends ZimbraStructTestCase
{
    public function testCheckDirSelector()
    {
        $path = $this->faker->word;
        $dir = new CheckDirSelector($path, false);
        $this->assertSame($path, $dir->getPath());
        $this->assertFalse($dir->isCreate());

        $dir = new CheckDirSelector('', false);
        $dir->setPath($path)
            ->setCreate(true);
        $this->assertSame($path, $dir->getPath());
        $this->assertTrue($dir->isCreate());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<directory path="' . $path . '" create="true" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dir, 'xml'));

        $tzi = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\CheckDirSelector', 'xml');
        $this->assertSame($path, $dir->getPath());
        $this->assertTrue($dir->isCreate());
    }
}
