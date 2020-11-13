<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\ExportAndDeleteItemSpec;
use Zimbra\Admin\Struct\ExportAndDeleteMailboxSpec;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ExportAndDeleteMailboxSpec.
 */
class ExportAndDeleteMailboxSpecTest extends ZimbraStructTestCase
{
    public function testExportAndDeleteMailboxSpec()
    {
        $id = mt_rand(1, 100);
        $version = mt_rand(1, 100);
        $item1 = new ExportAndDeleteItemSpec($id, $version);
        $item2 = new ExportAndDeleteItemSpec($version, $id);

        $mbox = new ExportAndDeleteMailboxSpec($id, [$item1]);
        $this->assertSame($id, $mbox->getId());
        $this->assertSame([$item1], $mbox->getItems());

        $mbox = new ExportAndDeleteMailboxSpec(0, []);
        $mbox->setId($id)
             ->setItems([$item1])
             ->addItem($item2);

        $this->assertSame($id, $mbox->getId());
        $this->assertSame([$item1, $item2], $mbox->getItems());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<mbox id="' . $id . '">'
                . '<item id="' . $id . '" version="' . $version . '" />'
                . '<item id="' . $version . '" version="' . $id . '" />'
            . '</mbox>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($mbox, 'xml'));
        $this->assertEquals($mbox, $this->serializer->deserialize($xml, ExportAndDeleteMailboxSpec::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($mbox, 'json'));
        $this->assertEquals($mbox, $this->serializer->deserialize($json, ExportAndDeleteMailboxSpec::class, 'json'));
    }
}
