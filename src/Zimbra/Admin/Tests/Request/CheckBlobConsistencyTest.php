<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\CheckBlobConsistency;
use Zimbra\Admin\Struct\IntIdAttr;

/**
 * Testcase class for CheckBlobConsistency.
 */
class CheckBlobConsistencyTest extends ZimbraAdminApiTestCase
{
    public function testCheckBlobConsistencyRequest()
    {
        $vid = mt_rand(0, 100);
        $mid = mt_rand(0, 100);
        $volume = new IntIdAttr($vid);
        $mbox = new IntIdAttr($mid);

        $req = new CheckBlobConsistency([$volume], [$mbox], true, false);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame([$volume], $req->getVolumes()->all());
        $this->assertSame([$mbox], $req->getMailboxes()->all());
        $this->assertTrue($req->getCheckSize());
        $this->assertFalse($req->getReportUsedBlobs());

        $req->addVolume($volume)
            ->addMailbox($mbox)
            ->setCheckSize(false)
            ->setReportUsedBlobs(true);
        $this->assertSame([$volume, $volume], $req->getVolumes()->all());
        $this->assertSame([$mbox, $mbox], $req->getMailboxes()->all());
        $this->assertFalse($req->getCheckSize());
        $this->assertTrue($req->getReportUsedBlobs());
        $req->getVolumes()->remove(1);
        $req->getMailboxes()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckBlobConsistencyRequest checkSize="false" reportUsedBlobs="true">'
                . '<volume id="' . $vid . '" />'
                . '<mbox id="' . $mid . '" />'
            . '</CheckBlobConsistencyRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CheckBlobConsistencyRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'checkSize' => false,
                'reportUsedBlobs' => true,
                'volume' => [
                    [
                        'id' => $vid,
                    ],
                ],
                'mbox' => [
                    [
                        'id' => $mid
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckBlobConsistencyApi()
    {
        $vid = mt_rand(0, 100);
        $mid = mt_rand(0, 100);
        $volume = new IntIdAttr($vid);
        $mbox = new IntIdAttr($mid);

        $this->api->checkBlobConsistency(
            [$volume], [$mbox], true, false
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CheckBlobConsistencyRequest checkSize="true" reportUsedBlobs="false">'
                        . '<urn1:volume id="' . $vid . '" />'
                        . '<urn1:mbox id="' . $mid . '" />'
                    . '</urn1:CheckBlobConsistencyRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
