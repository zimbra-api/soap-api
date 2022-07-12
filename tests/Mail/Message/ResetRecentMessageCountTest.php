<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\ResetRecentMessageCountEnvelope;
use Zimbra\Mail\Message\ResetRecentMessageCountBody;
use Zimbra\Mail\Message\ResetRecentMessageCountRequest;
use Zimbra\Mail\Message\ResetRecentMessageCountResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ResetRecentMessageCount.
 */
class ResetRecentMessageCountTest extends ZimbraTestCase
{
    public function testResetRecentMessageCount()
    {
        $request = new ResetRecentMessageCountRequest();
        $response = new ResetRecentMessageCountResponse();

        $body = new ResetRecentMessageCountBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ResetRecentMessageCountBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ResetRecentMessageCountEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new ResetRecentMessageCountEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ResetRecentMessageCountRequest />
        <urn:ResetRecentMessageCountResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ResetRecentMessageCountEnvelope::class, 'xml'));
    }
}
