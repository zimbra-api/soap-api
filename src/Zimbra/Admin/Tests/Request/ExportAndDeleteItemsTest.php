<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\ExportAndDeleteItems;
use Zimbra\Admin\Struct\ExportAndDeleteItemSpec;
use Zimbra\Admin\Struct\ExportAndDeleteMailboxSpec;

/**
 * Testcase class for ExportAndDeleteItems.
 */
class ExportAndDeleteItemsTest extends ZimbraAdminApiTestCase
{
    public function testExportAndDeleteItemsRequest()
    {
        $id = mt_rand(1, 100);
        $version = mt_rand(1, 100);
        $exportDir = $this->faker->word;
        $prefix = $this->faker->word;

        $item = new ExportAndDeleteItemSpec($id, $version);
        $mbox = new ExportAndDeleteMailboxSpec($id, [$item]);

        $req = new \Zimbra\Admin\Request\ExportAndDeleteItems($mbox, $exportDir, $prefix);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($mbox, $req->getMailbox());
        $this->assertSame($exportDir, $req->getExportDir());
        $this->assertSame($prefix, $req->getExportFilenamePrefix());

        $req->setMailbox($mbox)
            ->setExportDir($exportDir)
            ->getExportFilenamePrefix($prefix);
        $this->assertSame($mbox, $req->getMailbox());
        $this->assertSame($exportDir, $req->getExportDir());
        $this->assertSame($prefix, $req->getExportFilenamePrefix());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ExportAndDeleteItemsRequest exportDir="' . $exportDir . '" exportFilenamePrefix="' . $prefix . '">'
                . '<mbox id="' . $id . '">'
                    . '<item id="' . $id . '" version="' . $version . '" />'
                . '</mbox>'
            . '</ExportAndDeleteItemsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ExportAndDeleteItemsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'exportDir' => $exportDir,
                'exportFilenamePrefix' => $prefix,
                'mbox' => [
                    'id' => $id,
                    'item' => [
                        [
                            'id' => $id,
                            'version' => $version,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testExportAndDeleteItemsApi()
    {
        $id = mt_rand(1, 100);
        $version = mt_rand(1, 100);
        $exportDir = $this->faker->word;
        $prefix = $this->faker->word;

        $item = new ExportAndDeleteItemSpec($id, $version);
        $mbox = new ExportAndDeleteMailboxSpec($id, [$item]);

        $this->api->exportAndDeleteItems(
            $mbox, $exportDir, $prefix
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ExportAndDeleteItemsRequest exportDir="' . $exportDir . '" exportFilenamePrefix="' . $prefix . '">'
                        . '<urn1:mbox id="' . $id . '">'
                            . '<urn1:item id="' . $id . '" version="' . $version . '" />'
                        . '</urn1:mbox>'
                    . '</urn1:ExportAndDeleteItemsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
