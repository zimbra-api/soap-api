<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\ExportAndDeleteItemSpec;

/**
 * Testcase class for ExportAndDeleteItemSpec.
 */
class ExportAndDeleteItemSpecTest extends ZimbraAdminTestCase
{
    public function testExportAndDeleteItemSpec()
    {
        $id = mt_rand(1, 100);
        $version = mt_rand(1, 100);

        $item = new ExportAndDeleteItemSpec($id, $version);
        $this->assertSame($id, $item->getId());
        $this->assertSame($version, $item->getVersion());

        $item->setId($id)
             ->setVersion($version);
        $this->assertSame($id, $item->getId());
        $this->assertSame($version, $item->getVersion());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<item id="' . $id . '" version="' . $version . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $item);

        $array = [
            'item' => [
                'id' => $id,
                'version' => $version,
            ],
        ];
        $this->assertEquals($array, $item->toArray());
    }
}
