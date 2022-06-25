<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\GetLastItemIdInMailboxEnvelope;
use Zimbra\Mail\Message\GetLastItemIdInMailboxBody;
use Zimbra\Mail\Message\GetLastItemIdInMailboxRequest;
use Zimbra\Mail\Message\GetLastItemIdInMailboxResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetLastItemIdInMailbox.
 */
class GetLastItemIdInMailboxTest extends ZimbraTestCase
{
    public function testGetLastItemIdInMailbox()
    {
        $id = $this->faker->randomNumber;

        $request = new GetLastItemIdInMailboxRequest();
        $response = new GetLastItemIdInMailboxResponse($id);
        $this->assertSame($id, $response->getId());
        $response = new GetLastItemIdInMailboxResponse(0);
        $response->setId($id);
        $this->assertSame($id, $response->getId());

        $body = new GetLastItemIdInMailboxBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetLastItemIdInMailboxBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetLastItemIdInMailboxEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetLastItemIdInMailboxEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetLastItemIdInMailboxRequest />
        <urn:GetLastItemIdInMailboxResponse>
            <id>$id</id>
        </urn:GetLastItemIdInMailboxResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetLastItemIdInMailboxEnvelope::class, 'xml'));
    }
}
