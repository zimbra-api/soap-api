<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\DeleteMailboxBody;
use Zimbra\Admin\Message\DeleteMailboxEnvelope;
use Zimbra\Admin\Message\DeleteMailboxRequest;
use Zimbra\Admin\Message\DeleteMailboxResponse;
use Zimbra\Admin\Struct\MailboxByAccountIdSelector;
use Zimbra\Admin\Struct\MailboxWithMailboxId;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DeleteMailbox.
 */
class DeleteMailboxTest extends ZimbraTestCase
{
    public function testDeleteMailbox()
    {
        $id = $this->faker->uuid;
        $mbxid = $this->faker->randomNumber;
        $size = $this->faker->randomNumber;

        $mbox = new MailboxByAccountIdSelector($id);
        $request = new DeleteMailboxRequest($mbox);
        $this->assertSame($mbox, $request->getMbox());
        $request = new DeleteMailboxRequest();
        $request->setMbox($mbox);
        $this->assertSame($mbox, $request->getMbox());

        $mbox = new MailboxWithMailboxId($mbxid, $id, $size);
        $response = new DeleteMailboxResponse($mbox);
        $this->assertSame($mbox, $response->getMbox());
        $response = new DeleteMailboxResponse();
        $response->setMbox($mbox);
        $this->assertSame($mbox, $response->getMbox());

        $body = new DeleteMailboxBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DeleteMailboxBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DeleteMailboxEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new DeleteMailboxEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeleteMailboxRequest>
            <urn:mbox id="$id" />
        </urn:DeleteMailboxRequest>
        <urn:DeleteMailboxResponse>
            <urn:mbox mbxid="$mbxid" id="$id" s="$size" />
        </urn:DeleteMailboxResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DeleteMailboxEnvelope::class, 'xml'));
    }
}
