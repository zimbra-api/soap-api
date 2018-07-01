<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\ExportAndDeleteItemSpec;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ExportAndDeleteItemSpec.
 */
class ExportAndDeleteItemSpecTest extends ZimbraStructTestCase
{
    public function testExportAndDeleteItemSpec()
    {
        $id = mt_rand(1, 100);
        $version = mt_rand(1, 100);

        $item = new ExportAndDeleteItemSpec($id, $version);
        $this->assertSame($id, $item->getId());
        $this->assertSame($version, $item->getVersion());

        $item = new ExportAndDeleteItemSpec(0, 0);
        $item->setId($id)
             ->setVersion($version);
        $this->assertSame($id, $item->getId());
        $this->assertSame($version, $item->getVersion());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<item id="' . $id . '" version="' . $version . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($item, 'xml'));

        $item = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\ExportAndDeleteItemSpec', 'xml');
        $this->assertSame($id, $item->getId());
        $this->assertSame($version, $item->getVersion());
    }
}
