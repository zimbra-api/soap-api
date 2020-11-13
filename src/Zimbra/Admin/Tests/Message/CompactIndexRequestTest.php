<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CompactIndexRequest;
use Zimbra\Admin\Struct\MailboxByAccountIdSelector;
use Zimbra\Enum\CompactIndexAction;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CompactIndexRequest.
 */
class CompactIndexRequestTest extends ZimbraStructTestCase
{
    public function testCompactIndexRequest()
    {
        $id = $this->faker->uuid;
        $mbox = new MailboxByAccountIdSelector($id);

        $req = new CompactIndexRequest($mbox, CompactIndexAction::STATUS());
        $this->assertEquals($mbox, $req->getMbox());
        $this->assertEquals(CompactIndexAction::STATUS(), $req->getAction());

        $req = new CompactIndexRequest(new MailboxByAccountIdSelector(''));
        $req->setMbox($mbox)
            ->setAction(CompactIndexAction::START());
        $this->assertEquals($mbox, $req->getMbox());
        $this->assertEquals(CompactIndexAction::START(), $req->getAction());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CompactIndexRequest action="' . CompactIndexAction::START() . '">'
                . '<mbox id="' . $id . '" />'
            . '</CompactIndexRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CompactIndexRequest::class, 'xml'));

        $json = json_encode([
            'mbox' => [
                'id' => $id,
            ],
            'action' => (string) CompactIndexAction::START(),
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CompactIndexRequest::class, 'json'));
    }
}
