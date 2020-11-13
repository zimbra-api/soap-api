<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Message\CheckBlobConsistencyRequest;
use Zimbra\Admin\Struct\IntIdAttr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckBlobConsistencyRequest.
 */
class CheckBlobConsistencyRequestTest extends ZimbraStructTestCase
{
    public function testCheckBlobConsistencyRequest()
    {
        $volumeId = mt_rand(1, 100);
        $mboxId = mt_rand(1, 100);

        $volume = new IntIdAttr($volumeId);
        $mbox = new IntIdAttr($mboxId);
        $req = new CheckBlobConsistencyRequest(
            FALSE, FALSE, [$volume], [$mbox]
        );

        $this->assertFalse($req->getCheckSize());
        $this->assertFalse($req->getReportUsedBlobs());
        $this->assertEquals([$volume], $req->getVolumes());
        $this->assertEquals([$mbox], $req->getMailboxes());

        $req = new CheckBlobConsistencyRequest();
        $req->setCheckSize(TRUE)
            ->setReportUsedBlobs(TRUE)
            ->setVolumes([$volume])
            ->addVolume($volume)
            ->setMailboxes([$mbox])
            ->addMailbox($mbox);
        $this->assertTrue($req->getCheckSize());
        $this->assertTrue($req->getReportUsedBlobs());
        $this->assertEquals([$volume, $volume], $req->getVolumes());
        $this->assertEquals([$mbox, $mbox], $req->getMailboxes());

        $req = new CheckBlobConsistencyRequest(
            TRUE, TRUE, [$volume], [$mbox]
        );
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckBlobConsistencyRequest checkSize="true" reportUsedBlobs="true">'
                . '<volume id="' . $volumeId . '" />'
                . '<mbox id="' . $mboxId . '" />'
            . '</CheckBlobConsistencyRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CheckBlobConsistencyRequest::class, 'xml'));

        $json = json_encode([
            'checkSize' => TRUE,
            'reportUsedBlobs' => TRUE,
            'volume' => [
                [
                    'id' => $volumeId,
                ]
            ],
            'mbox' => [
                [
                    'id' => $mboxId,
                ]
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CheckBlobConsistencyRequest::class, 'json'));
    }
}
