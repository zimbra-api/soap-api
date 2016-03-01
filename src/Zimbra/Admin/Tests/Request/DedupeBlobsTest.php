<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\DedupeBlobs;
use Zimbra\Admin\Struct\IntIdAttr;
use Zimbra\Enum\DedupAction;

/**
 * Testcase class for DedupeBlobs.
 */
class DedupeBlobsTest extends ZimbraAdminApiTestCase
{
    public function testDedupeBlobsRequest()
    {
        $id = mt_rand(0, 100);
        $volume = new IntIdAttr($id);
        $req = new DedupeBlobs(DedupAction::START(), [$volume]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('start', $req->getAction()->value());
        $this->assertSame([$volume], $req->getVolumes()->all());

        $req->setAction(DedupAction::STATUS())
            ->addVolume($volume);
        $this->assertSame('status', $req->getAction()->value());
        $this->assertSame([$volume, $volume], $req->getVolumes()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DedupeBlobsRequest action="' . DedupAction::STATUS() . '">'
                . '<volume id="' . $id . '" />'
                . '<volume id="' . $id . '" />'
            . '</DedupeBlobsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DedupeBlobsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'action' => DedupAction::STATUS()->value(),
                'volume' => [
                    [
                        'id' => $id,
                    ],
                    [
                        'id' => $id,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDedupeBlobsApi()
    {
        $id = mt_rand(0, 100);
        $volume = new IntIdAttr($id);

        $this->api->dedupeBlobs(
            DedupAction::STATUS(), [$volume]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DedupeBlobsRequest action="' . DedupAction::STATUS() . '">'
                        . '<urn1:volume id="' . $id . '" />'
                    . '</urn1:DedupeBlobsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
