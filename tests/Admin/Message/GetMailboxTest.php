<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetMailboxBody;
use Zimbra\Admin\Message\GetMailboxEnvelope;
use Zimbra\Admin\Message\GetMailboxRequest;
use Zimbra\Admin\Message\GetMailboxResponse;

use Zimbra\Admin\Struct\MailboxByAccountIdSelector;
use Zimbra\Admin\Struct\MailboxWithMailboxId;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetMailbox.
 */
class GetMailboxTest extends ZimbraTestCase
{
    public function testGetMailbox()
    {
        $id = $this->faker->uuid;
        $mbxid = mt_rand(1, 100);
        $size = mt_rand(1, 100);

        $mbox = new MailboxByAccountIdSelector($id);
        $request = new GetMailboxRequest($mbox);
        $this->assertSame($mbox, $request->getMbox());

        $request = new GetMailboxRequest();
        $request->setMbox($mbox);
        $this->assertSame($mbox, $request->getMbox());

        $mbox = new MailboxWithMailboxId($mbxid, $id, $size);
        $response = new GetMailboxResponse($mbox);
        $this->assertSame($mbox, $response->getMbox());
        $response = new GetMailboxResponse(new MailboxWithMailboxId(0, $id, 0));
        $response->setMbox($mbox);
        $this->assertSame($mbox, $response->getMbox());

        $body = new GetMailboxBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetMailboxBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetMailboxEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetMailboxEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetMailboxRequest>
            <mbox id="$id" />
        </urn:GetMailboxRequest>
        <urn:GetMailboxResponse>
            <mbox mbxid="$mbxid" id="$id" s="$size" />
        </urn:GetMailboxResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetMailboxEnvelope::class, 'xml'));
    }
}
