<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\CheckDirSelector;

/**
 * Testcase class for CheckDirSelector.
 */
class CheckDirSelectorTest extends ZimbraAdminTestCase
{
    public function testCheckDirSelector()
    {
        $path = $this->faker->word;
        $dir = new CheckDirSelector($path, false);
        $this->assertSame($path, $dir->getPath());
        $this->assertFalse($dir->isCreate());

        $dir->setPath($path)
            ->setCreate(true);
        $this->assertSame($path, $dir->getPath());
        $this->assertTrue($dir->isCreate());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<directory path="' . $path . '" create="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $dir);

        $array = [
            'directory' => [
                'path' => $path,
                'create' => true,
            ],
        ];
        $this->assertEquals($array, $dir->toArray());
    }
}
