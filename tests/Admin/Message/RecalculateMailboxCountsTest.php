<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\RecalculateMailboxCountsBody;
use Zimbra\Admin\Message\RecalculateMailboxCountsEnvelope;
use Zimbra\Admin\Message\RecalculateMailboxCountsRequest;
use Zimbra\Admin\Message\RecalculateMailboxCountsResponse;
use Zimbra\Admin\Struct\MailboxByAccountIdSelector;
use Zimbra\Admin\Struct\MailboxQuotaInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RecalculateMailboxCountsTest.
 */
class RecalculateMailboxCountsTest extends ZimbraTestCase
{
    public function testRecalculateMailboxCounts()
    {
        $id = $this->faker->uuid;
        $mbxid = $this->faker->randomNumber;
        $size = $this->faker->randomNumber;
        $quotaUsed = $this->faker->randomNumber;

        $mbox = new MailboxByAccountIdSelector($id);
        $request = new RecalculateMailboxCountsRequest($mbox);
        $this->assertSame($mbox, $request->getMbox());
        $request = new RecalculateMailboxCountsRequest(new MailboxByAccountIdSelector());
        $request->setMbox($mbox);
        $this->assertSame($mbox, $request->getMbox());

        $mbox = new MailboxQuotaInfo($id, $quotaUsed);
        $response = new RecalculateMailboxCountsResponse($mbox);
        $this->assertSame($mbox, $response->getMailbox());
        $response = new RecalculateMailboxCountsResponse();
        $response->setMailbox($mbox);
        $this->assertSame($mbox, $response->getMailbox());

        $body = new RecalculateMailboxCountsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new RecalculateMailboxCountsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new RecalculateMailboxCountsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new RecalculateMailboxCountsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:RecalculateMailboxCountsRequest>
            <urn:mbox id="$id" />
        </urn:RecalculateMailboxCountsRequest>
        <urn:RecalculateMailboxCountsResponse>
            <urn:mbox id="$id" used="$quotaUsed" />
        </urn:RecalculateMailboxCountsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, RecalculateMailboxCountsEnvelope::class, 'xml'));
    }
}
