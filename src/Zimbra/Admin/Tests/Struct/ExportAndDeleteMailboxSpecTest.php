<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\ExportAndDeleteItemSpec;
use Zimbra\Admin\Struct\ExportAndDeleteMailboxSpec;

/**
 * Testcase class for ExportAndDeleteMailboxSpec.
 */
class ExportAndDeleteMailboxSpecTest extends ZimbraAdminTestCase
{
    public function testExportAndDeleteMailboxSpec()
    {
        $id = mt_rand(1, 100);
        $version = mt_rand(1, 100);
        $item1 = new ExportAndDeleteItemSpec($id, $version);
        $item2 = new ExportAndDeleteItemSpec($version, $id);

        $mbox = new ExportAndDeleteMailboxSpec($id, [$item1]);
        $this->assertSame($id, $mbox->getId());
        $this->assertSame([$item1], $mbox->getItems()->all());

        $mbox->setId($id)
             ->addItem($item2);

        $this->assertSame($id, $mbox->getId());
        $this->assertSame([$item1, $item2], $mbox->getItems()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<mbox id="' . $id . '">'
                . '<item id="' . $id . '" version="' . $version . '" />'
                . '<item id="' . $version . '" version="' . $id . '" />'
            . '</mbox>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $mbox);

        $array = [
            'mbox' => [
                'id' => $id,
                'item' => [
                    [
                        'id' => $id,
                        'version' => $version,
                    ],
                    [
                        'id' => $version,
                        'version' => $id,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $mbox->toArray());
    }
}
