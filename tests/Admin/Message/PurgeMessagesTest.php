<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\PurgeMessagesBody;
use Zimbra\Admin\Message\PurgeMessagesEnvelope;
use Zimbra\Admin\Message\PurgeMessagesRequest;
use Zimbra\Admin\Message\PurgeMessagesResponse;

use Zimbra\Admin\Struct\MailboxByAccountIdSelector;
use Zimbra\Admin\Struct\MailboxWithMailboxId;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for PurgeMessagesTest.
 */
class PurgeMessagesTest extends ZimbraTestCase
{
    public function testPurgeMessages()
    {
        $id = $this->faker->uuid;
        $mbxid = mt_rand(1, 100);
        $size = mt_rand(1, 100);

        $mbox = new MailboxByAccountIdSelector($id);
        $request = new PurgeMessagesRequest($mbox);
        $this->assertSame($mbox, $request->getMbox());
        $request = new PurgeMessagesRequest();
        $request->setMbox($mbox);
        $this->assertSame($mbox, $request->getMbox());

        $mbox = new MailboxWithMailboxId($mbxid, $id, $size);
        $response = new PurgeMessagesResponse([$mbox]);
        $this->assertSame([$mbox], $response->getMailboxes());
        $response = new PurgeMessagesResponse();
        $response->setMailboxes([$mbox])
            ->addMailbox($mbox);
        $this->assertSame([$mbox, $mbox], $response->getMailboxes());
        $response->setMailboxes([$mbox]);

        $body = new PurgeMessagesBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new PurgeMessagesBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new PurgeMessagesEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new PurgeMessagesEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:PurgeMessagesRequest>
            <urn:mbox id="$id" />
        </urn:PurgeMessagesRequest>
        <urn:PurgeMessagesResponse>
            <urn:mbox mbxid="$mbxid" id="$id" s="$size" />
        </urn:PurgeMessagesResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, PurgeMessagesEnvelope::class, 'xml'));
    }
}
